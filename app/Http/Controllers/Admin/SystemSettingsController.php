<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use App\Services\SystemSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemSettingsController extends Controller
{
    protected $settingsService;
    
    public function __construct(SystemSettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generalSettings = SystemSetting::where('group', 'general')->get();
        $aboutSettings = SystemSetting::where('group', 'about')->get();
        $contactSettings = SystemSetting::where('group', 'contact')->get();
        
        return view('admin.settings.index', compact('generalSettings', 'aboutSettings', 'contactSettings'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $setting = SystemSetting::findOrFail($id);
        return view('admin.settings.show', compact('setting'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = SystemSetting::findOrFail($id);
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting = SystemSetting::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'nullable|string',
            'is_public' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $setting->update($request->all());
        
        // Clear cache after updating settings
        $this->settingsService->clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $setting = SystemSetting::findOrFail($id);
        $setting->delete();
        
        // Clear cache after deleting setting
        $this->settingsService->clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
    
    /**
     * Bulk update settings
     */
    public function bulkUpdate(Request $request)
    {
        $settings = $request->except('_token', '_method');
        
        // Handle hero image upload separately
        if ($request->hasFile('file_hero_image')) {
            $file = $request->file('file_hero_image');
            
            // Store the file in the public disk under hero_images directory
            $filePath = $file->store('hero_images', 'public');
            
            // Deactivate all existing hero images
            \App\Models\HeroImage::where('is_active', true)->update(['is_active' => false]);
            
            // Create a new hero image record with file path
            \App\Models\HeroImage::create([
                'name' => 'Hero Background Image',
                'file_path' => $filePath,
                'mime_type' => $file->getMimeType(),
                'is_active' => true
            ]);
            
            // Log success for debugging
            \Illuminate\Support\Facades\Log::info('Hero image uploaded successfully to: ' . $filePath);
        }
        
        foreach ($settings as $key => $value) {
            // Skip file input fields and hero_image (now handled separately)
            if (strpos($key, 'file_') === 0 || $key === 'hero_image') {
                continue;
            }
            
            $setting = SystemSetting::where('key', $key)->first();
            if ($setting) {
                // Handle file uploads for other image type settings
                if ($setting->type === 'image' && $request->hasFile('file_' . $key)) {
                    $file = $request->file('file_' . $key);
                    // Store image as BLOB in database
                    $blobValue = base64_encode(file_get_contents($file->getRealPath()));
                    $mimeType = $file->getMimeType();
                    
                    // Save the setting with the new BLOB value
                    $setting->value = $blobValue;
                    $setting->mime_type = $mimeType;
                    $setting->save();
                } else {
                    // For non-image settings or when no new file is uploaded
                    // Don't update the value for image fields if they show "Image stored as BLOB" or "uploading_new_image"
                    if (!($setting->type === 'image' && ($value === 'Image stored as BLOB' || $value === 'uploading_new_image'))) {
                        $setting->value = $value;
                        $setting->save();
                    }
                }
            }
        }
        
        // Clear cache after bulk updating settings
        $this->settingsService->clearCache();
        
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    // Methods already defined above
}
