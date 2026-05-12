<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingService
{
    /**
     * Cache key for settings
     */
    private const CACHE_KEY = 'app_settings';

    /**
     * Get all settings from cache or database
     */
    public function all(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get a specific setting value
     */
    public function get(string $key, $default = null)
    {
        $settings = $this->all();
        return $settings[$key] ?? $default;
    }

    /**
     * Update multiple settings
     */
    public function update(array $data): void
    {
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Invalidate cache
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Update a single setting
     */
    public function set(string $key, $value): void
    {
        $this->update([$key => $value]);
    }

    /**
     * Handle file upload for settings like logo and favicon
     */
    public function uploadFile($file, string $key, string $directory = 'settings')
    {
        // Delete old file if exists
        $oldFile = $this->get($key);
        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }

        // Store new file
        $path = $file->store($directory, 'public');
        
        // Save to DB
        $this->set($key, $path);

        return $path;
    }
}
