<?php

namespace App\Http\Controllers;

use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $settings = $this->settingService->all();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'app_logo', 'app_favicon']);
        
        // Handle normal text settings
        $this->settingService->update($data);

        // Handle file uploads
        if ($request->hasFile('app_logo')) {
            $request->validate(['app_logo' => 'image|mimes:jpeg,png,jpg,svg|max:2048']);
            $this->settingService->uploadFile($request->file('app_logo'), 'app_logo');
        }

        if ($request->hasFile('app_favicon')) {
            $request->validate(['app_favicon' => 'image|mimes:ico,png,svg|max:1024']);
            $this->settingService->uploadFile($request->file('app_favicon'), 'app_favicon');
        }

        return redirect()->back()->with('success', 'Konfigurasi sistem berhasil diperbarui.');
    }
}
