<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SystemSettingsService;

class AboutController extends Controller
{
    protected $settingsService;

    public function __construct(SystemSettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        $aboutSettings = $this->settingsService->getSettingsByGroup('about');
        
        return view('about', compact('aboutSettings'));
    }
}