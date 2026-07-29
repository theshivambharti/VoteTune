<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['group' => 'general', 'key' => 'site_name', 'value' => 'VoteTune', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'general', 'key' => 'tagline', 'value' => 'The ultimate music voting platform', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'general', 'key' => 'timezone', 'value' => 'UTC', 'type' => 'string', 'sort_order' => 3],
            ['group' => 'general', 'key' => 'date_format', 'value' => 'Y-m-d', 'type' => 'string', 'sort_order' => 4],
            ['group' => 'general', 'key' => 'time_format', 'value' => 'H:i:s', 'type' => 'string', 'sort_order' => 5],
            ['group' => 'general', 'key' => 'language', 'value' => 'en', 'type' => 'string', 'sort_order' => 6],
            ['group' => 'general', 'key' => 'currency', 'value' => 'USD', 'type' => 'string', 'sort_order' => 7],

            // Branding
            ['group' => 'branding', 'key' => 'logo', 'value' => '', 'type' => 'file', 'sort_order' => 1],
            ['group' => 'branding', 'key' => 'dark_logo', 'value' => '', 'type' => 'file', 'sort_order' => 2],
            ['group' => 'branding', 'key' => 'favicon', 'value' => '', 'type' => 'file', 'sort_order' => 3],
            ['group' => 'branding', 'key' => 'primary_color', 'value' => '#3b82f6', 'type' => 'string', 'sort_order' => 4],
            ['group' => 'branding', 'key' => 'secondary_color', 'value' => '#1d4ed8', 'type' => 'string', 'sort_order' => 5],
            ['group' => 'branding', 'key' => 'default_theme', 'value' => 'light', 'type' => 'string', 'sort_order' => 6],
            ['group' => 'branding', 'key' => 'footer_text', 'value' => 'VoteTune Footer', 'type' => 'string', 'sort_order' => 7],
            ['group' => 'branding', 'key' => 'copyright', 'value' => '© 2026 VoteTune. All rights reserved.', 'type' => 'string', 'sort_order' => 8],

            // SEO
            ['group' => 'seo', 'key' => 'meta_title', 'value' => 'VoteTune', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'seo', 'key' => 'meta_description', 'value' => 'Collaborative music voting.', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'seo', 'key' => 'keywords', 'value' => 'music, voting, collaborate', 'type' => 'string', 'sort_order' => 3],
            ['group' => 'seo', 'key' => 'robots', 'value' => 'index, follow', 'type' => 'string', 'sort_order' => 4],
            ['group' => 'seo', 'key' => 'canonical_url', 'value' => '', 'type' => 'string', 'sort_order' => 5],
            ['group' => 'seo', 'key' => 'open_graph', 'value' => '1', 'type' => 'boolean', 'sort_order' => 6],
            ['group' => 'seo', 'key' => 'twitter_cards', 'value' => '1', 'type' => 'boolean', 'sort_order' => 7],

            // SMTP
            ['group' => 'smtp', 'key' => 'smtp_mailer', 'value' => 'smtp', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'smtp', 'key' => 'smtp_host', 'value' => '127.0.0.1', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'smtp', 'key' => 'smtp_port', 'value' => '1025', 'type' => 'integer', 'sort_order' => 3],
            ['group' => 'smtp', 'key' => 'smtp_username', 'value' => '', 'type' => 'string', 'sort_order' => 4],
            ['group' => 'smtp', 'key' => 'smtp_password', 'value' => '', 'type' => 'password', 'is_encrypted' => true, 'sort_order' => 5],
            ['group' => 'smtp', 'key' => 'smtp_encryption', 'value' => 'tls', 'type' => 'string', 'sort_order' => 6],
            ['group' => 'smtp', 'key' => 'smtp_from_name', 'value' => 'VoteTune', 'type' => 'string', 'sort_order' => 7],
            ['group' => 'smtp', 'key' => 'smtp_from_address', 'value' => 'noreply@votetune.com', 'type' => 'string', 'sort_order' => 8],

            // Social Login
            ['group' => 'social_login', 'key' => 'google_login_enabled', 'value' => '0', 'type' => 'boolean', 'sort_order' => 1],
            ['group' => 'social_login', 'key' => 'google_client_id', 'value' => '', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'social_login', 'key' => 'google_client_secret', 'value' => '', 'type' => 'password', 'is_encrypted' => true, 'sort_order' => 3],
            
            ['group' => 'social_login', 'key' => 'facebook_login_enabled', 'value' => '0', 'type' => 'boolean', 'sort_order' => 4],
            ['group' => 'social_login', 'key' => 'facebook_client_id', 'value' => '', 'type' => 'string', 'sort_order' => 5],
            ['group' => 'social_login', 'key' => 'facebook_client_secret', 'value' => '', 'type' => 'password', 'is_encrypted' => true, 'sort_order' => 6],
            
            ['group' => 'social_login', 'key' => 'apple_login_enabled', 'value' => '0', 'type' => 'boolean', 'sort_order' => 7],
            ['group' => 'social_login', 'key' => 'apple_client_id', 'value' => '', 'type' => 'string', 'sort_order' => 8],
            ['group' => 'social_login', 'key' => 'apple_client_secret', 'value' => '', 'type' => 'password', 'is_encrypted' => true, 'sort_order' => 9],

            // Analytics
            ['group' => 'analytics', 'key' => 'google_analytics', 'value' => '', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'analytics', 'key' => 'google_tag_manager', 'value' => '', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'analytics', 'key' => 'facebook_pixel', 'value' => '', 'type' => 'string', 'sort_order' => 3],
            ['group' => 'analytics', 'key' => 'custom_header_scripts', 'value' => '', 'type' => 'string', 'sort_order' => 4],
            ['group' => 'analytics', 'key' => 'custom_footer_scripts', 'value' => '', 'type' => 'string', 'sort_order' => 5],

            // Contact
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'contact@votetune.com', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'contact', 'key' => 'contact_address', 'value' => '', 'type' => 'string', 'sort_order' => 3],
            ['group' => 'contact', 'key' => 'google_maps_url', 'value' => '', 'type' => 'string', 'sort_order' => 4],
            ['group' => 'contact', 'key' => 'support_email', 'value' => 'support@votetune.com', 'type' => 'string', 'sort_order' => 5],

            // Social Media
            ['group' => 'social_media', 'key' => 'social_facebook', 'value' => '', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'social_media', 'key' => 'social_instagram', 'value' => '', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'social_media', 'key' => 'social_youtube', 'value' => '', 'type' => 'string', 'sort_order' => 3],
            ['group' => 'social_media', 'key' => 'social_x', 'value' => '', 'type' => 'string', 'sort_order' => 4],
            ['group' => 'social_media', 'key' => 'social_discord', 'value' => '', 'type' => 'string', 'sort_order' => 5],
            ['group' => 'social_media', 'key' => 'social_linkedin', 'value' => '', 'type' => 'string', 'sort_order' => 6],

            // Localization
            ['group' => 'localization', 'key' => 'default_language', 'value' => 'en', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'localization', 'key' => 'default_country', 'value' => 'US', 'type' => 'string', 'sort_order' => 2],

            // Appearance
            ['group' => 'appearance', 'key' => 'appearance_light_theme', 'value' => 'default', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'appearance', 'key' => 'appearance_dark_theme', 'value' => 'default', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'appearance', 'key' => 'appearance_sidebar_style', 'value' => 'expanded', 'type' => 'string', 'sort_order' => 3],

            // Security
            ['group' => 'security', 'key' => 'session_timeout', 'value' => '120', 'type' => 'integer', 'sort_order' => 1],
            ['group' => 'security', 'key' => 'password_policy', 'value' => 'strong', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'security', 'key' => 'max_login_attempts', 'value' => '5', 'type' => 'integer', 'sort_order' => 3],
            ['group' => 'security', 'key' => 'remember_me_enabled', 'value' => '1', 'type' => 'boolean', 'sort_order' => 4],
            ['group' => 'security', 'key' => 'registration_enabled', 'value' => '1', 'type' => 'boolean', 'sort_order' => 5],
            ['group' => 'security', 'key' => 'email_verification_required', 'value' => '0', 'type' => 'boolean', 'sort_order' => 6],

            // Uploads
            ['group' => 'uploads', 'key' => 'allowed_image_types', 'value' => 'jpg,jpeg,png,gif,webp,svg', 'type' => 'string', 'sort_order' => 1],
            ['group' => 'uploads', 'key' => 'allowed_file_types', 'value' => 'pdf,doc,docx,txt,zip', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'uploads', 'key' => 'max_upload_size', 'value' => '5120', 'type' => 'integer', 'sort_order' => 3], // 5MB
            ['group' => 'uploads', 'key' => 'avatar_size', 'value' => '2048', 'type' => 'integer', 'sort_order' => 4],
            ['group' => 'uploads', 'key' => 'logo_size', 'value' => '2048', 'type' => 'integer', 'sort_order' => 5],

            // Maintenance
            ['group' => 'maintenance', 'key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'sort_order' => 1],
            ['group' => 'maintenance', 'key' => 'maintenance_message', 'value' => 'We are currently performing maintenance. Please check back later.', 'type' => 'string', 'sort_order' => 2],
            ['group' => 'maintenance', 'key' => 'maintenance_image', 'value' => '', 'type' => 'file', 'sort_order' => 3],
        ];

        foreach ($settings as $setting) {
            if (isset($setting['is_encrypted']) && $setting['is_encrypted'] && !empty($setting['value'])) {
                $setting['value'] = encrypt($setting['value']);
            }
            
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        // Clear cache
        Cache::forget(\App\Repositories\SettingRepository::CACHE_KEY);
    }
}
