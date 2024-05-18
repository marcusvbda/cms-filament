@php
    use App\Helpers\BladeTranslator;
@endphp
<section class="description-banner">
    <div class="container-fluid py-3">
        <div class="row">
            @foreach (data_get($pageAttributes, 'example_banner.banners', []) as $banner)
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
                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'description_banner.title'))) }}
                    </h2>
                    <p class="fs-5 text-muted" data-aos="fade-left">
                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'description_banner.ubtitle'))) }}
                    </p>
                    <img loading="lazy" class="w-100" data-aos="fade-up"
                        src="{{ data_get($pageAttributes, 'description_banner.banner.url') }}"
                        alt="{{ data_get($pageAttributes, 'description_banner.banner.meta.alt') }}" />
                </div>
            </div>
        </div>
    </div>
</section>
