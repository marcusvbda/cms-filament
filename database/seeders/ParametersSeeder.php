<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\Parameter;
use Illuminate\Database\Seeder;

class ParametersSeeder extends Seeder
{
    public function run(): void
    {
        Parameter::truncate();
        Component::where('name', 'Default component')->delete();

        Parameter::create([
            'key' => 'app_name',
            'label' => 'application name',
            'value' => 'ORANGE.',
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

        Parameter::create([
            'key' => 'site_title',
            'label' => 'site name',
            'value' => 'Gravity labs',
            'type' => 'text',
        ]);

        Parameter::create([
            'key' => 'site_description',
            'label' => 'site description',
            'value' => 'description of your site over here ....',
            'type' => 'textarea',
        ]);

        $component = Component::create([
            'name' => 'Default component'
        ]);

        $component->_attributes()->create([
            'key' => 'twitter_url',
            'type' => 'text',
            'textValue' => '#'
        ]);

        $component->_attributes()->create([
            'key' => 'instagram_url',
            'type' => 'text',
            'textValue' => '#'
        ]);

        $component->_attributes()->create([
            'key' => 'linkedin_url',
            'type' => 'text',
            'textValue' => '#'
        ]);

        Parameter::create([
            'key' => 'site_component_default',
            'label' => "default component in all pages",
            'value' => $component->id,
            'type' => 'component',
        ]);
    }
}
