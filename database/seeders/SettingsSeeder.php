<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::truncate();

        Setting::create([
            'key' => 'app_name',
            'label' => 'application name',
            'value' => 'ORANGE',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => 'menu_type',
            'label' => 'menu type',
            'value' => 'sidebar',
            'type' => 'select',
            'attributes' => [
                'options' => [
                    'topbar' => 'topbar',
                    'sidebar' => 'sidebar'
                ],
            ],
        ]);

        Setting::create([
            'key' => 'primary_color',
            'label' => 'primary color',
            'value' => '#EA580C',
            'type' => 'color'
        ]);
    }
}
