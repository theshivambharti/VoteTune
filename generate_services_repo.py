import os

classes = {
    'app/Repositories/BaseRepository.php': r"""<?php
namespace App\Repositories;

abstract class BaseRepository
{
    // Common repository logic
}
""",
    'app/Repositories/SettingRepository.php': r"""<?php
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
""",
    'app/Services/FileService.php': r"""<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService extends BaseService
{
    public function uploadImage(UploadedFile $file, string $path = 'settings', ?string $oldFile = null): string
    {
        if ($oldFile) {
            $this->deleteFile($oldFile);
        }
        
        return $file->store($path, 'public');
    }
    
    public function deleteFile(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
""",
    'app/Services/SettingService.php': r"""<?php
namespace App\Services;

use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\Mail;

class SettingService extends BaseService
{
    protected $repository;
    protected $fileService;

    public function __construct(SettingRepository $repository, FileService $fileService)
    {
        $this->repository = $repository;
        $this->fileService = $fileService;
    }

    public function updateGroup(string $group, array $data)
    {
        $settings = $this->repository->getGroup($group);
        
        foreach ($settings as $setting) {
            $key = $setting->key;
            
            // Handle file uploads (e.g. logo, favicon)
            if ($setting->type === 'file') {
                if (isset($data[$key]) && $data[$key] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $this->fileService->uploadImage($data[$key], 'settings', $setting->value);
                    $this->repository->update($key, $path);
                }
            } 
            // Handle boolean un-checked state (which doesn't send in POST)
            elseif ($setting->type === 'boolean') {
                $val = isset($data[$key]) ? true : false;
                $this->repository->update($key, $val);
            }
            // Normal values
            else {
                if (isset($data[$key])) {
                    $this->repository->update($key, $data[$key]);
                }
            }
        }
        
        return true;
    }

    public function getGroupedSettings()
    {
        return $this->repository->all()->groupBy('group')->sortBy(function($settings, $group) {
            return $settings->first()->sort_order;
        });
    }
    
    public function testSmtp(array $config, string $to)
    {
        // Temporarily override config to test
        config([
            'mail.mailers.smtp.host' => $config['smtp_host'],
            'mail.mailers.smtp.port' => $config['smtp_port'],
            'mail.mailers.smtp.username' => $config['smtp_username'],
            'mail.mailers.smtp.password' => $config['smtp_password'],
            'mail.mailers.smtp.encryption' => $config['smtp_encryption'],
            'mail.from.address' => $config['smtp_from_address'],
            'mail.from.name' => $config['smtp_from_name'],
        ]);
        
        Mail::raw('This is a test email from VoteTune SMTP settings.', function ($message) use ($to) {
            $message->to($to)
                    ->subject('VoteTune SMTP Test');
        });
    }
}
"""
}

os.makedirs('app/Repositories', exist_ok=True)
os.makedirs('app/Services', exist_ok=True)
for path, content in classes.items():
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)

print("Services and Repositories generated.")
