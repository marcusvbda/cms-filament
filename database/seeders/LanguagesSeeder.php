<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    public function run(): void
    {
        Language::truncate();

        Language::create([
            'name' => 'English',
            'code' => 'en',
            'flag' => 'usa.png',
            'items' => []
        ]);

        Language::create([
            'name' => 'Português Brasileiro',
            'code' => 'pt_BR',
            'flag' => 'brazil.png',
            'items' => [
                [
                    'key' => 'home',
                    'value' => 'início'
                ]
            ]
        ]);
    }
}
