<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class AboutSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Main title
            [
                'key' => 'about_title',
                'name' => 'About Page Title',
                'value' => 'About Mt. Cagua',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            // Our Story section
            [
                'key' => 'our_story_title',
                'name' => 'Our Story Title',
                'value' => 'Our Story',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'our_story_paragraph_1',
                'name' => 'Our Story First Paragraph',
                'value' => 'Mt. Cagua, located in Gonzaga, Cagayan Valley, is one of the most remarkable hiking destinations in the Philippines. Rising 1,113 meters above sea level, it offers breathtaking views of the Pacific Ocean and the surrounding landscape.',
                'type' => 'textarea',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'our_story_paragraph_2',
                'name' => 'Our Story Second Paragraph',
                'value' => 'Our mission is to provide safe and memorable hiking experiences while promoting environmental conservation and supporting local communities.',
                'type' => 'textarea',
                'group' => 'about',
                'is_public' => true,
            ],
            // Why Choose Us section
            [
                'key' => 'why_choose_us_title',
                'name' => 'Why Choose Us Title',
                'value' => 'Why Choose Us?',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            // Feature 1
            [
                'key' => 'feature_1_title',
                'name' => 'Feature 1 Title',
                'value' => 'Safety First',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'feature_1_description',
                'name' => 'Feature 1 Description',
                'value' => 'Experienced guides and well-maintained trails ensure your safety throughout the journey.',
                'type' => 'textarea',
                'group' => 'about',
                'is_public' => true,
            ],
            // Feature 2
            [
                'key' => 'feature_2_title',
                'name' => 'Feature 2 Title',
                'value' => 'Expert Guides',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'feature_2_description',
                'name' => 'Feature 2 Description',
                'value' => 'Our professional guides are certified and knowledgeable about the mountain\'s terrain and history.',
                'type' => 'textarea',
                'group' => 'about',
                'is_public' => true,
            ],
            // Feature 3
            [
                'key' => 'feature_3_title',
                'name' => 'Feature 3 Title',
                'value' => 'Community Support',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'feature_3_description',
                'name' => 'Feature 3 Description',
                'value' => 'We work closely with local communities to promote sustainable tourism and economic growth.',
                'type' => 'textarea',
                'group' => 'about',
                'is_public' => true,
            ],
            // Feature 4
            [
                'key' => 'feature_4_title',
                'name' => 'Feature 4 Title',
                'value' => 'Environmental Care',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'feature_4_description',
                'name' => 'Feature 4 Description',
                'value' => 'We practice and promote responsible hiking to preserve the mountain\'s natural beauty.',
                'type' => 'textarea',
                'group' => 'about',
                'is_public' => true,
            ],
            // Our Commitment section
            [
                'key' => 'commitment_title',
                'name' => 'Commitment Section Title',
                'value' => 'Our Commitment',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'commitment_intro',
                'name' => 'Commitment Introduction',
                'value' => 'We are committed to:',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'commitment_1',
                'name' => 'Commitment Item 1',
                'value' => 'Providing safe and enjoyable hiking experiences',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'commitment_2',
                'name' => 'Commitment Item 2',
                'value' => 'Protecting and preserving the mountain environment',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'commitment_3',
                'name' => 'Commitment Item 3',
                'value' => 'Supporting local communities through sustainable tourism',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'commitment_4',
                'name' => 'Commitment Item 4',
                'value' => 'Educating visitors about environmental conservation',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
            [
                'key' => 'commitment_5',
                'name' => 'Commitment Item 5',
                'value' => 'Maintaining high standards of service and safety',
                'type' => 'text',
                'group' => 'about',
                'is_public' => true,
            ],
        ];

        foreach ($settings as $setting) {
            // Skip if setting already exists
            if (!SystemSetting::where('key', $setting['key'])->exists()) {
                SystemSetting::create($setting);
            }
        }
    }
}