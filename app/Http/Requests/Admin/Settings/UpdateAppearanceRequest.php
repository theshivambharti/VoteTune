<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAppearanceRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'appearance_light_theme' => 'nullable|string',
            'appearance_dark_theme' => 'nullable|string',
            'appearance_sidebar_style' => 'nullable|string',
        ];
    }
}
