@php
    use App\Helpers\BladeTranslator;
@endphp

<section class="description-banner">
    <div class="container-fluid py-3">
        <div class="row">
            @foreach ($attributes->description_banners as $banner)
                <div class="col-12 col-md-4" data-aos="fade-up">
                    <div class="d-flex flex-column description-banner-item">
                        <img loading="lazy" src="{{ $banner->url }}" alt="{{ $banner->meta->alt }}" width="60%">
                        <h6 class="text-center">{{ $banner->meta->title }}</h6>
                        <p class="text-center">{{ $banner->meta->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
