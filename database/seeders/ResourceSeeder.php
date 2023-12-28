<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = $this->generateRandomTurkishWords(20);

        foreach ($words as $word) {
            Resource::create(['name' => $word, 'music_url' => null]);
        }
    }

    /**
     * Generates a list of random Turkish words.
     *
     * @param int $count Number of words to generate.
     * @return array
     */
    private function generateRandomTurkishWords($count): array
    {
        $vowels = ['a', 'e', 'ı', 'i', 'o', 'ö', 'u', 'ü'];
        $consonants = ['b', 'c', 'ç', 'd', 'f', 'g', 'ğ', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'r', 's', 'ş', 't', 'v', 'y', 'z'];
        $words = [];

        for ($i = 0; $i < $count; $i++) {
            $word = '';
            for ($j = 0; $j < rand(1, 3); $j++) {
                $word .= $consonants[array_rand($consonants)] . $vowels[array_rand($vowels)];
            }
            $words[] = $word;
        }

        return $words;
    }
}
