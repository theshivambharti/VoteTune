<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLocalizationRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'default_language' => 'required|string',
            'default_country' => 'required|string',
        ];
    }
}
