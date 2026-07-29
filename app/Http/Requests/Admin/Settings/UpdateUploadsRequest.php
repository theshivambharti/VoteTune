<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUploadsRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'allowed_image_types' => 'nullable|string',
            'allowed_file_types' => 'nullable|string',
            'max_upload_size' => 'nullable|integer',
            'avatar_size' => 'nullable|integer',
            'logo_size' => 'nullable|integer',
        ];
    }
}
