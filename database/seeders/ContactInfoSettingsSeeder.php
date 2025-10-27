<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactInfoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'office_address',
                'name' => 'Office Address',
                'value' => 'Gonzaga, Cagayan Valley, Philippines',
                'type' => 'textarea',
                'group' => 'contact',
                'is_public' => true,
            ],
            [
                'key' => 'phone_number',
                'name' => 'Phone Number',
                'value' => '+63 912 345 6789',
                'type' => 'text',
                'group' => 'contact',
                'is_public' => true,
            ],
            [
                'key' => 'email_address',
                'name' => 'Email Address',
                'value' => 'info@mtcagua.com',
                'type' => 'email',
                'group' => 'contact',
                'is_public' => true,
            ],
            [
                'key' => 'weekday_hours',
                'name' => 'Weekday Hours',
                'value' => 'Monday - Friday: 8:00 AM - 5:00 PM',
                'type' => 'text',
                'group' => 'contact',
                'is_public' => true,
            ],
            [
                'key' => 'weekend_hours',
                'name' => 'Weekend Hours',
                'value' => 'Saturday - Sunday: 9:00 AM - 3:00 PM',
                'type' => 'text',
                'group' => 'contact',
                'is_public' => true,
            ],
        ];

        foreach ($settings as $setting) {
            // Check if setting already exists
            $exists = DB::table('system_settings')
                ->where('key', $setting['key'])
                ->where('group', $setting['group'])
                ->exists();

            if (!$exists) {
                DB::table('system_settings')->insert($setting);
            }
        }
    }
}