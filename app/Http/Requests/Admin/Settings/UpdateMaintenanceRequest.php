<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'maintenance_mode' => 'nullable|boolean',
            'maintenance_message' => 'nullable|string',
            'maintenance_image' => 'nullable|image',
        ];
    }
}
