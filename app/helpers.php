<?php

if (!function_exists('setting')) {
    /**
     * Get a setting value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        try {
            return app(\App\Repositories\SettingRepository::class)->get($key, $default);
        } catch (\Exception $e) {
            return $default;
        }
    }
}

if (!function_exists('setting_bool')) {
    function setting_bool($key, $default = false): bool
    {
        $val = setting($key, $default);
        return filter_var($val, FILTER_VALIDATE_BOOLEAN);
    }
}

if (!function_exists('setting_int')) {
    function setting_int($key, $default = 0): int
    {
        return (int) setting($key, $default);
    }
}

if (!function_exists('setting_json')) {
    function setting_json($key, $default = '{}'): string
    {
        $val = setting($key, $default);
        if (is_array($val) || is_object($val)) {
            return json_encode($val);
        }
        return (string) $val;
    }
}

if (!function_exists('setting_array')) {
    function setting_array($key, $default = []): array
    {
        $val = setting($key, $default);
        if (is_array($val)) {
            return $val;
        }
        if (is_string($val)) {
            $decoded = json_decode($val, true);
            return is_array($decoded) ? $decoded : $default;
        }
        return $default;
    }
}
