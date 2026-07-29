import os

requests = {
    'app/Http/Requests/Auth/LoginRequest.php': r"""<?php
namespace App\Http\Requests\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean']
        ];
    }
}
""",
    'app/Http/Requests/Auth/RegisterRequest.php': r"""<?php
namespace App\Http\Requests\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
""",
    'app/Http/Requests/Auth/ForgotPasswordRequest.php': r"""<?php
namespace App\Http\Requests\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return ['email' => ['required', 'email']];
    }
}
""",
    'app/Http/Requests/Auth/ResetPasswordRequest.php': r"""<?php
namespace App\Http\Requests\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
""",
    'app/Http/Requests/User/ProfileUpdateRequest.php': r"""<?php
namespace App\Http\Requests\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'display_name' => ['nullable', 'string', 'max:255'],
        ];
    }
}
""",
    'app/Http/Requests/User/PasswordUpdateRequest.php': r"""<?php
namespace App\Http\Requests\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
"""
}

for path, content in requests.items():
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
        
print("Form requests updated.")
