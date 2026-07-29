<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'site_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'timezone' => 'required|string|timezone',
            'date_format' => 'required|string',
            'time_format' => 'required|string',
            'language' => 'required|string',
            'currency' => 'required|string',
        ];
    }
}
