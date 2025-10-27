<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SystemSettingsService
{
    /**
     * Get all public settings
     *
     * @return Collection
     */
    public function getPublicSettings(): Collection
    {
        return Cache::remember('public_settings', 60 * 60, function () {
            return SystemSetting::where('is_public', true)->get()
                ->mapWithKeys(function ($setting) {
                    return [$setting->key => $setting->value];
                });
        });
    }

    /**
     * Get settings by group
     *
     * @param string $group
     * @return Collection
     */
    public function getSettingsByGroup(string $group): Collection
    {
        return Cache::remember("settings_group_{$group}", 60 * 60, function () use ($group) {
            return SystemSetting::where('group', $group)
                ->where('is_public', true)
                ->get()
                ->mapWithKeys(function ($setting) {
                    return [$setting->key => $setting->value];
                });
        });
    }

    /**
     * Get a specific setting value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getSetting(string $key, $default = null)
    {
        return Cache::remember("setting_{$key}", 60 * 60, function () use ($key, $default) {
            $setting = SystemSetting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Clear settings cache
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget('public_settings');
        
        $groups = ['general', 'about', 'contact'];
        foreach ($groups as $group) {
            Cache::forget("settings_group_{$group}");
        }
        
        // Clear individual setting caches
        $keys = SystemSetting::pluck('key')->toArray();
        foreach ($keys as $key) {
            Cache::forget("setting_{$key}");
        }
    }
}