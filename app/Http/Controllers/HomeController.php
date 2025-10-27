<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use App\Models\Review;
use App\Services\SystemSettingsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $settingsService;
    
    public function __construct(SystemSettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }
    
    public function index()
    {
        // Get featured hikes for the homepage
        $featuredHikes = Hike::where('status', 'open')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get testimonials for the homepage
        $testimonials = Review::with('user')
            ->where('is_verified', true)
            ->where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            
        // Get all settings by group
        $aboutSettings = $this->settingsService->getSettingsByGroup('about');
        $contactSettings = $this->settingsService->getSettingsByGroup('contact');
        $generalSettings = $this->settingsService->getSettingsByGroup('general');
        
        // Get active hero image
        $heroImage = \App\Models\HeroImage::getActive();

        return view('home', compact(
            'featuredHikes', 
            'testimonials', 
            'aboutSettings', 
            'contactSettings',
            'generalSettings',
            'heroImage'
        ));
    }
}