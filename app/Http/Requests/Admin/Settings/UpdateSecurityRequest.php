<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSecurityRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'session_timeout' => 'nullable|integer',
            'password_policy' => 'nullable|string',
            'max_login_attempts' => 'nullable|integer',
            'remember_me_enabled' => 'nullable|boolean',
            'registration_enabled' => 'nullable|boolean',
            'email_verification_required' => 'nullable|boolean',
        ];
    }
}
