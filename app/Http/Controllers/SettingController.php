<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        $colors = ['red', 'blue', 'green', 'black', 'white', 'purple', 'orange', 'grey', 'yellow', 'pink'];
        $styles = ['serif', 'sans-serif', 'monospace', 'cursive', 'fantasy', 'Arial', 'Verdana', 'Times New Roman', 'Courier New', 'Georgia'];
        return view('settings.index', compact('settings', 'colors', 'styles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        $this->toggleStatus($setting);
        return redirect()->route('settings.index')->with('success', __('trans.Successfully changed'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        $this->toggleStatus($setting);
        return redirect()->route('settings.index')->with('success', __('trans.Successfully changed'));
    }

    private function toggleStatus(Setting $setting)
    {
        Setting::query()->update(['status' => $setting->status]);
        $setting->update(['status' => !$setting->status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function updateSettingStyle(Request $request)
    {
        Setting::query()->update([
            'font_style' => $request->style,
            'font_color' => $request->color,
            'font_size' => $request->size,
        ]);
        return redirect()->route('settings.index')->with('success', __('trans.Successfully updated'));
    }

}
