<?php

namespace App\Http\Controllers;

use App\Services\SystemSettingsService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $settingsService;
    
    public function __construct(SystemSettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        $contactSettings = $this->settingsService->getSettingsByGroup('contact');
        return view('contact', compact('contactSettings'));
    }
}