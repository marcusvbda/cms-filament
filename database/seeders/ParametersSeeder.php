<?php

namespace Database\Seeders;

use App\Models\Parameter;
use Illuminate\Database\Seeder;

class ParametersSeeder extends Seeder
{
    public function run(): void
    {
        Parameter::truncate();

        Parameter::create([
            'key' => 'admin_route',
            'label' => 'admin route',
            'value' => 'admin',
            'type' => 'text'
        ]);

        Parameter::create([
            'key' => 'app_name',
            'label' => 'application name',
            'value' => 'ORANGE',
            'type' => 'text',
        ]);

        Parameter::create([
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

        Parameter::create([
            'key' => 'primary_color',
            'label' => 'primary color',
            'value' => '#EA580C',
            'type' => 'color'
        ]);
    }
}
