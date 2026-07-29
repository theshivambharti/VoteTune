<?php
namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingRepository extends BaseRepository
{
    const CACHE_KEY = 'settings.all';

    public function all()
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return Setting::all()->keyBy('key');
        });
    }

    public function get(string $key, $default = null)
    {
        $settings = $this->all();
        
        if (!$settings->has($key)) {
            return $default;
        }

        $setting = $settings->get($key);
        
        // Handle encryption
        if ($setting->is_encrypted && !empty($setting->value)) {
            try {
                return decrypt($setting->value);
            } catch (\Exception $e) {
                return $default;
            }
        }
        
        // Handle automatic type casting based on type column
        return $this->castValue($setting->value, $setting->type);
    }
    
    protected function castValue($value, $type)
    {
        if (is_null($value)) {
            return null;
        }
        
        switch ($type) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'integer':
                return (int) $value;
            case 'json':
                return json_decode($value, true);
            default:
                return (string) $value;
        }
    }

    public function getGroup(string $group)
    {
        return $this->all()->where('group', $group);
    }

    public function update(string $key, $value, ?string $type = null)
    {
        $setting = Setting::where('key', $key)->first();
        
        if ($setting) {
            if ($setting->is_encrypted && !empty($value)) {
                $value = encrypt($value);
            }
            
            // Do not update password if value is empty/null
            if ($setting->type === 'password' && empty($value)) {
                return $setting;
            }
            
            $setting->update([
                'value' => $value,
                'updated_by' => auth()->id() ?? null,
            ]);
            
            $this->flushCache();
        }
        
        return $setting;
    }
    
    public function flushCache()
    {
        Cache::forget(self::CACHE_KEY);
    }
}
