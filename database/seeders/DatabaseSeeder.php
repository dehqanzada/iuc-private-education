<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

      $data = [
            [
                'name' => 'Jayhoon',
                'email' => 'jay.dehqanzada@gmail.com',
                'password' => Hash::make('87654321'),
            ],
            [
                'name' => 'Hamit Karaköse',
                'email' => 'tasarhamit@gmail.com',
                'password' => Hash::make('87654321'),
            ],
            [
                'name' => 'Duygu Mutlu Bayraktar',
                'email' => 'dmutlu@iuc.edu.tr',
                'password' => Hash::make('87654321'),
            ],
        ];

        foreach ($data ?? [] as $key => $value) {
            User::create($value);
        }

        $this->call([
            SettingSeeder::class,
            StudentSeeder::class,
            ResourceSeeder::class,
            ResourceGroupSeeder::class,
            ResourceGroupItemSeeder::class,
//            ExperienceSeeder::class,
//            ExamSeeder::class,
        ]);
    }
}
