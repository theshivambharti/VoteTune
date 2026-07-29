import os

requests = {
    'app/Http/Requests/Admin/Settings/UpdateGeneralRequest.php': r"""<?php
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
""",
    'app/Http/Requests/Admin/Settings/UpdateBrandingRequest.php': r"""<?php
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
""",
    'app/Http/Requests/Admin/Settings/UpdateSeoRequest.php': r"""<?php
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
""",
    'app/Http/Requests/Admin/Settings/UpdateSmtpRequest.php': r"""<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSmtpRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'smtp_mailer' => 'required|string',
            'smtp_host' => 'nullable|string',
            'smtp_port' => 'nullable|integer',
            'smtp_username' => 'nullable|string',
            'smtp_password' => 'nullable|string',
            'smtp_encryption' => 'nullable|string',
            'smtp_from_name' => 'required|string',
            'smtp_from_address' => 'required|email',
        ];
    }
}
""",
    'app/Http/Requests/Admin/Settings/UpdateSocialLoginRequest.php': r"""<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialLoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'google_login_enabled' => 'nullable|boolean',
            'google_client_id' => 'nullable|string',
            'google_client_secret' => 'nullable|string',
            
            'facebook_login_enabled' => 'nullable|boolean',
            'facebook_client_id' => 'nullable|string',
            'facebook_client_secret' => 'nullable|string',
            
            'apple_login_enabled' => 'nullable|boolean',
            'apple_client_id' => 'nullable|string',
            'apple_client_secret' => 'nullable|string',
        ];
    }
}
""",
    'app/Http/Requests/Admin/Settings/UpdateAnalyticsRequest.php': r"""<?php
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
""",
    'app/Http/Requests/Admin/Settings/UpdateContactRequest.php': r"""<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'google_maps_url' => 'nullable|url',
            'support_email' => 'nullable|email',
        ];
    }
}
""",
    'app/Http/Requests/Admin/Settings/UpdateSocialMediaRequest.php': r"""<?php
namespace App\Http\Requests\Admin\Settings;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialMediaRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_youtube' => 'nullable|url',
            'social_x' => 'nullable|url',
            'social_discord' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
        ];
    }
}
""",
    'app/Http/Requests/Admin/Settings/UpdateLocalizationRequest.php': r"""<?php
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
""",
    'app/Http/Requests/Admin/Settings/UpdateAppearanceRequest.php': r"""<?php
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
""",
    'app/Http/Requests/Admin/Settings/UpdateSecurityRequest.php': r"""<?php
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
""",
    'app/Http/Requests/Admin/Settings/UpdateUploadsRequest.php': r"""<?php
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
""",
    'app/Http/Requests/Admin/Settings/UpdateMaintenanceRequest.php': r"""<?php
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
"""
}

os.makedirs('app/Http/Requests/Admin/Settings', exist_ok=True)
for path, content in requests.items():
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)

print("Form requests generated.")
