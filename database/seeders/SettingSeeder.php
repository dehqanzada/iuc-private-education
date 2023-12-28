<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Capitalize all',
                'status' => true,
                'font_style' => 'serif',
                'font_color' => 'red',
                'font_size' => 55,
                'show_style' => false,
            ],
            [
                'name' => 'Lowercase all',
                'status' => false,
                'font_style' => 'serif',
                'font_color' => 'red',
                'font_size' => 55,
                'show_style' => false,
            ],
            [
                'name' => 'Just enlarge the first letter',
                'status' => false,
                'font_style' => 'serif',
                'font_color' => 'red',
                'font_size' => 55,
                'show_style' => false,
            ],
            [
                'name' => 'complex mode',
                'status' => false,
                'font_style' => 'serif',
                'font_color' => 'red',
                'font_size' => 55,
                'show_style' => false,
            ],
            [
                'name' => 'Font style',
                'status' => false,
                'font_style' => 'serif',
                'font_color' => 'red',
                'font_size' => 55,
                'show_style' => true,
            ],
            [
                'name' => 'Font size',
                'status' => false,
                'font_style' => 'serif',
                'font_color' => 'red',
                'font_size' => 55,
                'show_style' => true,
            ],
            [
                'name' => 'Font color',
                'status' => false,
                'font_style' => 'serif',
                'font_color' => 'red',
                'font_size' => 55,
                'show_style' => true,
            ],
        ];

        foreach ($data as $value) {
            Setting::create($value);
        }
    }
}
