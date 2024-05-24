<?php

namespace Database\Seeders;

use App\Models\Component;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    protected $componentHero, $exampleBanner, $descriptionBanner, $iconSetion, $casesSection, $testimonialsSection, $contactSection;

    public function run($action = null): void
    {
        if ($action) {
            $this->{$action}();
        } else {
            $this->createComponents();
            $this->createHome();
        }
    }

    public function createPortifolioPage()
    {
        $page = Page::create([
            'title' => 'Marcus Vinicius Bassalobre de Assis',
            'description' => 'lorem ipsum',
            'slug' => 'mvbassalobre',
            'type' => 'blade',
            'is_published' => true
        ]);
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

        $this->iconSetion = Component::create([
            'name' => 'Icon Section'
        ]);

        $this->iconSetion->_attributes()->create([
            'key' => 'title',
            'type' => 'text',
            'textValue' => 'unlock Your Creativity'
        ]);

        $this->iconSetion->_attributes()->create([
            'key' => 'subtitle',
            'type' => 'text',
            'textValue' => 'ligula risus auctor tempus magna feugiat lacinia.'
        ]);

        $this->iconSetion->_attributes()->create([
            'key' => 'infos',
            'type' => 'repeater',
            'repeaterType' => 'key',
            'repeaterValue' => array_map(function ($index) {
                return [
                    'keyValue' => [
                        'icon' => 'heroicon-s-star',
                        'title' => 'lorem ipsum',
                        'content' => 'Porta semper lacus cursus feugiat primis ultrice ligula risus ociis auctor and tempus feugiat impedit felis cursus auctor augue mauris blandit ipsum'
                    ]
                ];
            }, range(1, 6))
        ]);

        $this->iconSetion->_attributes()->create([
            'key' => 'title_2',
            'type' => 'text',
            'textValue' => 'scale your unique design process'
        ]);

        $this->iconSetion->_attributes()->create([
            'key' => 'subtitle_2',
            'type' => 'text',
            'textValue' => 'sodales tempor sapien quaerat congue eget ipsum laoreet turpis neque auctor vitae eros dolor luctus placerat magna ligula cursus and purus pretium'
        ]);

        $this->iconSetion->_attributes()->create([
            'key' => 'title_3',
            'type' => 'text',
            'textValue' => 'scale your unique design process'
        ]);

        $this->iconSetion->_attributes()->create([
            'key' => 'subtitle_3',
            'type' => 'text',
            'textValue' => 'sodales tempor sapien quaerat congue eget ipsum laoreet turpis neque auctor vitae eros dolor luctus placerat magna ligula cursus and purus pretium'
        ]);

        $this->iconSetion->_attributes()->create([
            'key' => 'image_3',
            'type' => 'file',
            'fileValue' => 'img-10.png',
            'metaValue' => [
                "alt" => "icon banner"
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

        $this->contactSection = Component::create([
            'name' => 'Section Contact'
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'form_url',
            'type' => 'text',
            'textValue' => "html://example.com"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'title',
            'type' => 'text',
            'textValue' => "questions? Let's Talk"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'description',
            'type' => 'text',
            'textValue' => "want to learn more about Martex, get a quote, or speak with an expert? Let us know what you
            are looking for and we’ll get back to you right away"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'description',
            'type' => 'text',
            'textValue' => "want to learn more about Martex, get a quote, or speak with an expert? Let us know what you
            are looking for and we’ll get back to you right away"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'q1_text',
            'type' => 'text',
            'textValue' => "this question is about"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'q1_desc',
            'type' => 'text',
            'textValue' => "choose a topic, so we know who to send your request to"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'q1_options',
            'type' => 'repeater',
            'repeaterType' => 'text',
            'repeaterValue' => array_map(function ($index) {
                return [
                    'textValue' => "option $index",
                ];
            }, range(1, 10))
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'q2_text',
            'type' => 'text',
            'textValue' => "Your Name"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'q2_desc',
            'type' => 'text',
            'textValue' => "Please enter your real name"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'q3_text',
            'type' => 'text',
            'textValue' => "Explain your question in details"
        ]);

        $this->contactSection->_attributes()->create([
            'key' => 'q3_desc',
            'type' => 'text',
            'textValue' => "Your OS version, Martex version & build, steps you did. Be VERY precise!"
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
            'key' => 'icon_section',
            'type' => 'component',
            'componentValue' => $this->iconSetion->id
        ]);

        $page->_attributes()->create([
            'key' => 'testimonials_section',
            'type' => 'component',
            'componentValue' => $this->testimonialsSection->id
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

        $page->_attributes()->create([
            'key' => 'section_contact',
            'type' => 'component',
            'componentValue' => $this->contactSection->id
        ]);
    }
}
