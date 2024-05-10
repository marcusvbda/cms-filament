<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Page::truncate();
        PageAttribute::truncate();
        $this->createHome();
    }

    public function createHome(): void
    {
        $page = Page::create([
            'title' => 'home',
            'description' => 'lorem ipsum',
            'slug' => 'index',
            'type' => 'blade',
            'is_published' => true
        ]);

        $page->pageAttributes()->create([
            'key' => 'logo',
            'type' => 'file',
            'fileValue' => 'logo.png',
            'metaValue' => [
                'alt' => 'logo',
            ]
        ]);

        $page->pageAttributes()->create([
            'key' => 'hero_title',
            'type' => 'text',
            'textValue' => 'enhance your website design with martex'
        ]);

        $page->pageAttributes()->create([
            'key' => 'hero_subtitle',
            'type' => 'text',
            'textValue' => 'mauris donec ociis diam magnis sapien sagittis sapien tempor volute gravida aliquet tortor undo aliquet an egestas in magna egestas sapien quaerat'
        ]);

        $page->pageAttributes()->create([
            'key' => 'hero_input_placeholder',
            'type' => 'text',
            'textValue' => 'enter your email here'
        ]);

        $page->pageAttributes()->create([
            'key' => 'hero_input_button',
            'type' => 'text',
            'textValue' => 'subscribe'
        ]);

        $page->pageAttributes()->create([
            'key' => 'hero_background',
            'type' => 'file',
            'fileValue' => 'hero-bg.jpeg',
            'metaValue' => []
        ]);

        $page->pageAttributes()->create([
            'key' => 'hero_swiper_brands',
            'type' => 'repeater',
            'repeaterType' => 'file',
            'repeaterValue' => array_map(function ($index) {
                return [
                    'fileValue' => "brand-$index.png",
                    'metaValue' => [
                        'alt' => 'brand ' . $index
                    ]
                ];
            }, range(1, 10))
        ]);
    }
}
