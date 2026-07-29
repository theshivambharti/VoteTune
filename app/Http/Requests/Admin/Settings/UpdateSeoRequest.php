<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSeoRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'robots' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'open_graph' => 'nullable|boolean',
            'twitter_cards' => 'nullable|boolean',
        ];
    }
}
