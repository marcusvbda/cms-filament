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
            'key' => 'favicon',
            'type' => 'file',
            'fileValue' => 'favicon.ico'
        ]);

        $component->_attributes()->create([
            'key' => 'logo',
            'type' => 'file',
            'fileValue' => 'logo.png'
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
