<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnalyticsRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'google_analytics' => 'nullable|string',
            'google_tag_manager' => 'nullable|string',
            'facebook_pixel' => 'nullable|string',
            'custom_header_scripts' => 'nullable|string',
            'custom_footer_scripts' => 'nullable|string',
        ];
    }
}
