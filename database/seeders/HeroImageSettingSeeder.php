<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroImageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds to add hero image setting.
     */
    public function run(): void
    {
        $setting = [
            'key' => 'hero_image',
            'name' => 'Hero Background Image',
            'value' => '/images/placeholder-mountain.svg',
            'type' => 'image',
            'group' => 'general',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Check if setting already exists
        $exists = DB::table('system_settings')
            ->where('key', $setting['key'])
            ->exists();

        if (!$exists) {
            DB::table('system_settings')->insert($setting);
            $this->command->info('Hero image setting created successfully.');
        } else {
            $this->command->info('Hero image setting already exists.');
        }
    }
}