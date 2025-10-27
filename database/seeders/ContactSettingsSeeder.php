<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds to add missing Contact page settings.
     */
    public function run(): void
    {
        $contactSettings = [
            // Existing settings (already in database)
            // 'office_address' => 'Gonzaga, Cagayan Valley, Philippines',
            // 'phone_number' => '+63 912 345 6789',
            // 'email_address' => 'info@mtcagua.com',
            // 'weekday_hours' => 'Monday - Friday: 8:00 AM - 5:00 PM',
            // 'weekend_hours' => 'Saturday - Sunday: 9:00 AM - 3:00 PM',
            
            // New settings for section titles
            'contact_title' => 'Contact Us',
            'get_in_touch_title' => 'Get in Touch',
            'send_message_title' => 'Send us a Message',
            'faq_title' => 'Frequently Asked Questions',
            
            // FAQ settings
            'faq1_question' => 'How do I book a hike?',
            'faq1_answer' => 'You can book a hike through our website by selecting your preferred trail and date. Create an account or log in to complete your booking.',
            'faq2_question' => 'What should I bring for a hike?',
            'faq2_answer' => 'Essential items include appropriate footwear, weather-suitable clothing, water, snacks, sunscreen, and a first aid kit. A detailed packing list will be provided upon booking.',
            'faq3_question' => 'Are there age restrictions for hiking?',
            'faq3_answer' => 'Different trails have different age requirements. Easy trails are suitable for all ages, while more challenging ones may have minimum age requirements. Check the trail details for specific information.',
        ];

        foreach ($contactSettings as $key => $value) {
            // Check if the setting already exists
            $exists = DB::table('system_settings')
                ->where('key', $key)
                ->where('group', 'contact')
                ->exists();
            
            // Only insert if the setting doesn't exist
            if (!$exists) {
                DB::table('system_settings')->insert([
                    'key' => $key,
                    'name' => ucwords(str_replace('_', ' ', $key)),
                    'value' => $value,
                    'type' => in_array($key, ['faq1_answer', 'faq2_answer', 'faq3_answer']) ? 'textarea' : 'text',
                    'group' => 'contact',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}