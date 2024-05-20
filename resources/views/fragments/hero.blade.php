@php
    use App\Helpers\BladeTranslator;
@endphp
<section class="hero" style="--hero-bg : url({{ data_get($pageAttributes, 'section_hero.background.url') }})">
    <div class="p-3 p-md-5">
        <div class="container-fluid py-5">
            <div class="row d-flex align-items-center justify-content-center" data-aos="fade-in">
                <div class="col-12 col-md-10 text-center">
                    <h1 class="display-3 fw-bold mb-4 text-center">
                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_hero.title'))) }}</h1>
                    <p class="fs-5 text-muted pb-5">
                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_hero.subtitle'))) }}</p>
                    <form method="POST" class="form-group input-group my-5 pb-4">
                        <input class="input-email form-control me-3" type="email"
                            placeholder="{{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_hero.input_placeholder'))) }}"
                            required="required">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg"
                                type="button">{{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'section_hero.input_button'))) }}</button>
                        </span>
                    </form>
                    <div class="swiper mt-4" id="hero-swiper">
                        <div class="swiper-wrapper">
                            @foreach (data_get($pageAttributes, 'section_hero.swiper_brands', []) as $slide)
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



<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        new Swiper("#hero-swiper", {
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
    });
</script>
