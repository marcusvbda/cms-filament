<section class="hero">
    <div class="p-3 p-md-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-10 text-center">
                    <h1 class="display-3 fw-bold mb-4 text-center">{{ __($attributes->hero_title) }}</h1>
                    <p class="fs-5 text-muted pb-5">{{ ucfirst(__($attributes->hero_subtitle)) }}</p>
                    <div class="form-group input-group my-5 pb-4">
                        <input class="input-email form-control me-3" type="email"
                            placeholder="{{ ucfirst(__($attributes->hero_input_placeholder)) }}" required="required">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg"
                                type="button">{{ ucfirst(__($attributes->hero_input_button)) }}</button>
                        </span>
                    </div>
                    <div class="swiper mt-4" id="hero-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($attributes->hero_swiper_brands as $slide)
                                <div class="swiper-slide">
                                    <img src="{{ $slide->url }}" alt="{{ $slide->meta->alt }}" height="70">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
