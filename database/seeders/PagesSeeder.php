<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    protected $componentHero, $exampleBanner, $descriptionBanner, $casesSection, $testimonialsSection;

    public function run(): void
    {
        $this->createComponents();
        $this->createHome();
        $this->createCases();
        $this->createContacts();
    }

    public function createComponents(): void
    {
        $this->componentHero = Component::create([
            'name' => 'Section Hero'
        ]);

        $this->componentHero->_attributes()->create([
            'key' => 'background',
            'type' => 'file',
            'fileValue' => 'hero-bg.jpeg',
            'metaValue' => []
        ]);

        $this->componentHero->_attributes()->create([
            'key' => 'title',
            'type' => 'text',
            'textValue' => 'enhance your website design with martex'
        ]);

        $this->componentHero->_attributes()->create([
            'key' => 'subtitle',
            'type' => 'text',
            'textValue' => 'mauris donec ociis diam magnis sapien sagittis sapien tempor volute gravida aliquet tortor undo aliquet an egestas in magna egestas sapien quaerat'
        ]);

        $this->componentHero->_attributes()->create([
            'key' => 'input_placeholder',
            'type' => 'text',
            'textValue' => 'enter your email here'
        ]);

        $this->componentHero->_attributes()->create([
            'key' => 'input_button',
            'type' => 'text',
            'textValue' => 'subscribe'
        ]);

        $this->componentHero->_attributes()->create([
            'key' => 'background',
            'type' => 'file',
            'fileValue' => 'hero-bg.jpeg',
            'metaValue' => []
        ]);

        $this->componentHero->_attributes()->create([
            'key' => 'swiper_brands',
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

        $this->exampleBanner = Component::create([
            'name' => 'Example Banner'
        ]);

        $this->exampleBanner->_attributes()->create([
            'key' => 'banners',
            'type' => 'repeater',
            'repeaterType' => 'file',
            'repeaterValue' => array_map(function ($index) {
                return [
                    'fileValue' => "desc-banner-$index.png",
                    'metaValue' => [
                        'title' => 'lorem ipsum',
                        'description' => 'luctus egestas augue undo ultrice aliquam in lacus congue dapibus',
                        'alt' => 'description banner ' . $index
                    ]
                ];
            }, range(1, 3))
        ]);

        $this->descriptionBanner = Component::create([
            'name' => 'Description Banner'
        ]);

        $this->descriptionBanner->_attributes()->create([
            'key' => 'title',
            'type' => 'text',
            'textValue' => 'affordable solutions for all your creativity needs'
        ]);

        $this->descriptionBanner->_attributes()->create([
            'key' => 'subtitle',
            'type' => 'text',
            'textValue' => 'aliquam a augue suscipit luctus neque purus ipsum neque diam dolor primis libero tempus, blandit and cursus varius and magnis sodales'
        ]);

        $this->descriptionBanner->_attributes()->create([
            'key' => 'banner',
            'type' => 'file',
            'fileValue' => 'desc-banner-banner.png',
            'metaValue' => [
                'alt' => 'banner description'
            ]
        ]);

        $this->casesSection = Component::create([
            'name' => 'Section Cases'
        ]);

        $this->casesSection->_attributes()->create([
            'key' => 'header_title',
            'type' => 'text',
            'textValue' => 'great design that works!'
        ]);

        $this->casesSection->_attributes()->create([
            'key' => 'header_description',
            'type' => 'text',
            'textValue' => 'ligula risus auctor tempus magna feugiat lacinia.'
        ]);

        $this->casesSection->_attributes()->create([
            'key' => 'cases',
            'type' => 'repeater',
            'repeaterType' => 'file',
            'repeaterValue' => array_map(function ($index) {
                return [
                    'fileValue' => "case-$index.jpeg",
                    'metaValue' => [
                        'title' => 'case ' . $index,
                        'url' => '#'
                    ]
                ];
            }, range(1, 3))
        ]);

        $this->testimonialsSection = Component::create([
            'name' => 'Testimonials Section'
        ]);

        $this->testimonialsSection->_attributes()->create([
            'key' => 'header_title',
            'type' => 'text',
            'textValue' => 'our Happy Customers'
        ]);

        $this->testimonialsSection->_attributes()->create([
            'key' => 'header_description',
            'type' => 'text',
            'textValue' => 'ligula risus auctor tempus magna feugiat lacinia.'
        ]);

        $this->testimonialsSection->_attributes()->create([
            'key' => 'testimonials',
            'type' => 'repeater',
            'repeaterType' => 'file',
            'repeaterValue' => array_map(function ($index) {
                return [
                    'fileValue' => "author.jpg",
                    'metaValue' => [
                        'content' => 'Quaerat sodales sapien euismod blandit aliquet ipsum primis undo and cubilia laoreet augue and luctus magna dolor luctus egestas sapien vitae',
                        'name' => 'John Doe',
                        'description' => 'Company CEO'
                    ]
                ];
            }, range(1, 5))
        ]);
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

        $page->_attributes()->create([
            'key' => 'section_hero',
            'type' => 'component',
            'componentValue' => $this->componentHero->id
        ]);

        $page->_attributes()->create([
            'key' => 'example_banner',
            'type' => 'component',
            'componentValue' => $this->exampleBanner->id
        ]);

        $page->_attributes()->create([
            'key' => 'description_banner',
            'type' => 'component',
            'componentValue' => $this->descriptionBanner->id
        ]);

        $page->_attributes()->create([
            'key' => 'testimonials_section',
            'type' => 'component',
            'componentValue' => $this->testimonialsSection->id
        ]);
    }

    public function createCases(): void
    {
        $page = Page::create([
            'title' => 'cases',
            'description' => 'lorem ipsum',
            'slug' => 'cases',
            'type' => 'blade',
            'is_published' => true
        ]);

        $page->_attributes()->create([
            'key' => 'cases_section',
            'type' => 'component',
            'componentValue' => $this->casesSection->id
        ]);

        $page->_attributes()->create([
            'key' => 'testimonials_section',
            'type' => 'component',
            'componentValue' => $this->testimonialsSection->id
        ]);
    }

    private function createContacts()
    {
        $page = Page::create([
            'title' => 'contact',
            'description' => 'lorem ipsum',
            'slug' => 'contact',
            'type' => 'blade',
            'is_published' => true
        ]);
    }
}
