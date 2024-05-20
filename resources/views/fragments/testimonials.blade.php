@php
    use App\Helpers\BladeTranslator;
@endphp
<section id="testimonials-page">
    <section class="header">
        <div class="p-3 p-md-5">
            <div class="container-fluid">
                <div class="row d-flex align-items-center justify-content-center card-banner">
                    <div class="col-12 col-md-10 text-center">
                        <h1 class="display-3 fw-bold mb-4 text-center" data-aos="fade-left">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'testimonials_section.header_title'))) }}
                        </h1>
                        <p class="fs-5 text-muted pb-5" data-aos="fade-right">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'testimonials_section.header_description'))) }}
                        </p>
                        <div id="testimonial-items" data-aos="fade-up">
                            <div class="swiper-wrapper">
                                @foreach (data_get($pageAttributes, 'testimonials_section.testimonials', []) as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonials-card">
                                            @svg('bi-quote', ['height' => 100, 'width' => 100, 'class' => 'quote-icon'])
                                            <div class="content">
                                                {{ ucfirst(BladeTranslator::__(data_get($testimonial, 'meta.content'))) }}
                                            </div>
                                            <div class="author">
                                                <div class="avatar"
                                                    style="--avatar : url({{ data_get($testimonial, 'url') }})">
                                                </div>
                                                <div class="info">
                                                    <div class="name">
                                                        {{ ucfirst(BladeTranslator::__(data_get($testimonial, 'meta.name'))) }}
                                                    </div>
                                                    <div class="description">
                                                        {{ ucfirst(BladeTranslator::__(data_get($testimonial, 'meta.description'))) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>



<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        new Swiper("#testimonial-items", {
            direction: 'horizontal',
            spaceBetween: 6,
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 2,
                    spaceBetween: 50,
                },
            },
        });
    });
</script>
