<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General Settings
        $this->createSetting('hero_title', 'Hero Title', 'Experience the Thrill of Mt. Cagua', 'text', 'general', true);
        $this->createSetting('hero_subtitle', 'Hero Subtitle', 'Discover breathtaking views and unforgettable adventures with our expert-guided hiking tours.', 'textarea', 'general', true);
        
        $this->createSetting('features_title', 'Features Section Title', 'Why Choose Mt. Cagua?', 'text', 'general', true);
        $this->createSetting('feature1_title', 'Feature 1 Title', 'Safe Adventures', 'text', 'general', true);
        $this->createSetting('feature1_description', 'Feature 1 Description', 'Experience safe and well-planned hiking adventures with our certified guides and maintained trails.', 'textarea', 'general', true);
        $this->createSetting('feature2_title', 'Feature 2 Title', 'Expert Guides', 'text', 'general', true);
        $this->createSetting('feature2_description', 'Feature 2 Description', 'Our professional guides are highly trained and knowledgeable about the mountain\'s terrain and history.', 'textarea', 'general', true);
        $this->createSetting('feature3_title', 'Feature 3 Title', 'Community Support', 'text', 'general', true);
        $this->createSetting('feature3_description', 'Feature 3 Description', 'We work with local communities to promote sustainable tourism and support economic growth.', 'textarea', 'general', true);
        
        $this->createSetting('cta_title', 'CTA Title', 'Ready for Your Next Adventure?', 'text', 'general', true);
        $this->createSetting('cta_description', 'CTA Description', 'Join us for an unforgettable trekking experience at Mt. Cagua. Book your trek today!', 'textarea', 'general', true);
        
        // About Settings
        $this->createSetting('about_title', 'About Section Title', 'About Mt. Cagua', 'text', 'about', true);
        $this->createSetting('about_content', 'About Content', 'Mt. Cagua is a beautiful mountain located in the Philippines, offering breathtaking views and unforgettable hiking experiences.', 'textarea', 'about', true);
        $this->createSetting('about_mission', 'Our Mission', 'To provide safe, enjoyable, and educational hiking experiences while promoting environmental conservation and supporting local communities.', 'textarea', 'about', true);
        $this->createSetting('about_vision', 'Our Vision', 'To be the leading provider of sustainable mountain tourism in the region.', 'textarea', 'about', true);
        
        // Contact Settings
        $this->createSetting('contact_email', 'Contact Email', 'info@mtcagua.com', 'email', 'contact', true);
        $this->createSetting('contact_phone', 'Contact Phone', '+63 912 345 6789', 'text', 'contact', true);
        $this->createSetting('contact_address', 'Contact Address', '123 Mountain View Road, Gonzaga, Cagayan, Philippines', 'textarea', 'contact', true);
        $this->createSetting('business_hours', 'Business Hours', 'Monday - Friday: 8:00 AM - 5:00 PM', 'text', 'contact', true);
    }
    
    /**
     * Create a system setting
     */
    private function createSetting(string $key, string $name, string $value, string $type, string $group, bool $isPublic): void
    {
        SystemSetting::updateOrCreate(
            ['key' => $key],
            [
                'name' => $name,
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'is_public' => $isPublic,
            ]
        );
    }
}