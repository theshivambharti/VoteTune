<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandingRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'logo' => 'nullable|image|max:2048',
            'dark_logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
            'primary_color' => 'nullable|string',
            'secondary_color' => 'nullable|string',
            'default_theme' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'copyright' => 'nullable|string',
        ];
    }
}
