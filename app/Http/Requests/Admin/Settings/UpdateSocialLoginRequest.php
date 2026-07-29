<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialLoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'google_login_enabled' => 'nullable|boolean',
            'google_client_id' => 'nullable|string',
            'google_client_secret' => 'nullable|string',
            
            'facebook_login_enabled' => 'nullable|boolean',
            'facebook_client_id' => 'nullable|string',
            'facebook_client_secret' => 'nullable|string',
            
            'apple_login_enabled' => 'nullable|boolean',
            'apple_client_id' => 'nullable|string',
            'apple_client_secret' => 'nullable|string',
        ];
    }
}
