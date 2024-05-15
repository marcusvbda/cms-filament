@extends('layouts.default')
@php
    use App\Helpers\BladeTranslator;
@endphp

@section('title', ucfirst(BladeTranslator::__(data_get($page, 'title'))))
@section('description', ucfirst(BladeTranslator::__(data_get($page, 'description'))))

@section('content')
    <div id="home-page">
        <section class="hero" style="--hero-bg : url({{ $attributes->hero_background->url }})">
            <div class="p-3 p-md-5">
                <div class="container-fluid py-5">
                    <div class="row d-flex align-items-center justify-content-center" data-aos="fade-in">
                        <div class="col-12 col-md-10 text-center">
                            <h1 class="display-3 fw-bold mb-4 text-center">
                                {{ ucfirst(BladeTranslator::__(data_get($attributes, 'hero_title'))) }}</h1>
                            <p class="fs-5 text-muted pb-5">
                                {{ ucfirst(BladeTranslator::__(data_get($attributes, 'hero_subtitle'))) }}</p>
                            <div class="form-group input-group my-5 pb-4">
                                <input class="input-email form-control me-3" type="email"
                                    placeholder="{{ ucfirst(BladeTranslator::__(data_get($attributes, 'hero_input_placeholder'))) }}"
                                    required="required">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-lg"
                                        type="button">{{ ucfirst(BladeTranslator::__(data_get($attributes, 'hero_input_button'))) }}</button>
                                </span>
                            </div>
                            <div class="swiper mt-4" id="hero-swiper">
                                <div class="swiper-wrapper">
                                    @foreach (data_get($attributes, 'hero_swiper_brands', []) as $slide)
                                        <div class="swiper-slide">
                                            <img loading="lazy" src="{{ data_get($slide, 'url') }}"
                                                alt="{{ data_get($slide, 'meta.alt') }}" height="70">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="description-banner">
            <div class="container-fluid py-3">
                <div class="row">
                    @foreach (data_get($attributes, 'description_banners', []) as $banner)
                        <div class="col-12 col-md-4" data-aos="fade-up">
                            <div class="d-flex flex-column description-banner-item">
                                <img loading="lazy" src="{{ $banner->url }}" alt="{{ data_get($banner, 'meta.alt') }}"
                                    width="60%">
                                <h6 class="text-center">{{ BladeTranslator::__(data_get($banner, 'meta.title')) }}</h6>
                                <p class="text-center">{{ BladeTranslator::__(data_get($banner, 'meta.description')) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row description-banner--banner px-4">
                    <div class="col-12">
                        <div class="content">
                            <h2 class="display-3 fw-bold mb-4 text-center" data-aos="fade-right">
                                {{ ucfirst(BladeTranslator::__(data_get($attributes, 'banner_description_title'))) }}</h2>
                            <p class="fs-5 text-muted" data-aos="fade-left">
                                {{ ucfirst(BladeTranslator::__(data_get($attributes, 'banner_description_subtitle'))) }}
                            </p>
                            <img loading="lazy" class="w-100" data-aos="fade-up"
                                src="{{ data_get($attributes, 'banner_description_banner.url') }}"
                                alt="{{ data_get($attributes, 'banner_description_banner.meta.alt') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="icons-section">
            <div class="p-3 p-md-5">
                <div class="container-fluid py-5">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-12 col-md-10 text-center">
                            <h1 class="display-3 fw-bold mb-4 text-center" data-aos="fade-left">
                                Unlock Your Creativity
                            </h1>
                            <p class="fs-5 text-muted pb-5" data-aos="fade-right">
                                Ligula risus auctor tempus magna feugiat lacinia.
                            </p>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-12 col-md-6 columns-icon">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <h3 class="d-flex align-items-center gap-3">
                                            <x-uni-star-thin class="svg" />
                                            Lorem ipsum dolor
                                        </h3>
                                        <p class="text-muted">Porta semper lacus cursus feugiat primis ultrice ligula risus
                                            ociis
                                            auctor and
                                            tempus feugiat impedit felis cursus auctor augue mauris blandit ipsum</p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="col-12 col-md-6 columns-icon">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <h3 class="d-flex align-items-center gap-3">
                                            <x-uni-star-thin class="svg" />
                                            Lorem ipsum dolor
                                        </h3>
                                        <p class="text-muted">Porta semper lacus cursus feugiat primis ultrice ligula risus
                                            ociis
                                            auctor and
                                            tempus feugiat impedit felis cursus auctor augue mauris blandit ipsum</p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="row icons-section--banner" data-aos="fade-left">
                        <div class="col-12 col-md-5 px-4 mb-sm-4">
                            <img loading="lazy" class="w-100"
                                src="https://jthemes.net/themes/wp/martex/wp-content/uploads/2023/07/img-10.png"
                                alt="icon banner">
                        </div>
                        <div class="col-12 col-md-7 s-md-5 d-flex flex-column justify-between gap-3" data-aos="fade-right">
                            <div>
                                <h3 class="h1 fw-bold mb-4">
                                    Scale your unique design process
                                </h3>
                                <p class="fs-5 text-muted">
                                    Sodales tempor sapien quaerat congue eget ipsum laoreet turpis neque auctor vitae eros
                                    dolor
                                    luctus placerat magna ligula cursus and purus pretium
                                </p>
                            </div>
                            <div>
                                <h4 class="h3 fw-bold mb-4">
                                    Scale your unique design process
                                </h4>
                                <p class="fs-5 text-muted">
                                    Sodales tempor sapien quaerat congue eget ipsum laoreet turpis neque auctor vitae eros
                                    dolor
                                    luctus placerat magna ligula cursus and purus pretium
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<script type="module">
    const swiper = new Swiper("#hero-swiper", {
        direction: 'horizontal',
        spaceBetween: 6,
        slidesPerView: 3,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 50,
            },
        },
    });
</script>
