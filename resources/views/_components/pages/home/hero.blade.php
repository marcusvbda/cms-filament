<section class="hero">
    <div class="p-3 p-md-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-10 text-center">
                    <h1 class="display-3 fw-bold mb-4 text-center">{{ $attributes->hero_title }}</h1>
                    <p class="fs-5 text-muted pb-5">{{ ucfirst($attributes->hero_subtitle) }}</p>
                    <div class="form-group input-group my-5">
                        <input class="input-email form-control me-3" type="email"
                            placeholder="{{ ucfirst($attributes->hero_input_placeholder) }}" required="required">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg"
                                type="button">{{ ucfirst($attributes->hero_input_button) }}</button>
                        </span>
                    </div>
                    <div class="swiper" id="hero-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">Slide 1</div>
                            <div class="swiper-slide">Slide 2</div>
                            <div class="swiper-slide">Slide 3</div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="module">
    const swiper = new Swiper("#hero-swiper")
</script>
