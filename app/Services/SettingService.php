<?php
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
