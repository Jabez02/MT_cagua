<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Services\SystemSettingsService;

class FrontLayoutComposer
{
    protected $settingsService;

    public function __construct(SystemSettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $contactSettings = $this->settingsService->getSettingsByGroup('contact');
        
        $view->with('contactSettings', $contactSettings);
    }
}