<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'app_name', 'value' => 'Inventori Pro', 'type' => 'text', 'group' => 'general'],
            ['key' => 'app_description', 'value' => 'Platform inventori modern untuk UMKM retail.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'app_logo', 'value' => '', 'type' => 'image', 'group' => 'branding'],
            ['key' => 'app_favicon', 'value' => '', 'type' => 'image', 'group' => 'branding'],
            ['key' => 'contact_email', 'value' => 'support@inventoripro.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '081234567890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jl. Sudirman No. 123, Jakarta', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'footer_text', 'value' => '© ' . date('Y') . ' Inventori Pro. All rights reserved.', 'type' => 'text', 'group' => 'branding'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
