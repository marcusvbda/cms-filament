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
            'title' => 'Home',
            'blade' => 'index',
            'is_published' => true
        ]);

        $page->pageAttributes()->create([
            'key' => 'hero_title',
            'type' => 'text',
            'textValue' => 'enhance your website design with Martex'
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
    }
}
