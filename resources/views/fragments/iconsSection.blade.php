@php
    use App\Helpers\BladeTranslator;
@endphp
<section class="icons-section">
    <div class="p-3 p-md-5">
        <div class="container-fluid py-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-10 text-center">
                    <h1 class="display-3 fw-bold mb-4 text-center" data-aos="fade-left">
                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'icon_section.title'))) }}
                    </h1>
                    <p class="fs-5 text-muted pb-5" data-aos="fade-right">
                        {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'icon_section.subtitle'))) }}
                    </p>
                </div>
            </div>
            <div class="row" data-aos="fade-up">
                @foreach (data_get($pageAttributes, 'icon_section.infos', []) as $item)
                    <div class="col-12 col-md-6 columns-icon">
                        <div class="row mb-5">
                            <div class="col-12">
                                <h3 class="d-flex align-items-center gap-3">
                                    @svg(data_get($item, 'icon'), ['class' => 'svg'])
                                    {{ ucfirst(BladeTranslator::__(data_get($item, 'title'))) }}
                                </h3>
                                <p class="text-muted">
                                    {{ ucfirst(BladeTranslator::__(data_get($item, 'content'))) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row icons-section--banner" data-aos="fade-left">
                <div class="col-12 col-md-5 px-4 mb-sm-4">
                    <img loading="lazy" class="w-100" src="{{ data_get($pageAttributes, 'icon_section.image_3.url') }}"
                        alt="{{ data_get($pageAttributes, 'icon_section.image_3.meta.alt') }}">
                </div>
                <div class="col-12 col-md-7 s-md-5 d-flex flex-column justify-between gap-3" data-aos="fade-right">
                    <div>
                        <h3 class="h1 fw-bold mb-4">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'icon_section.title_2'))) }}</h1>
                        </h3>
                        <p class="fs-5 text-muted">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'icon_section.subtitle_2'))) }}
                        </p>
                    </div>
                    <div>
                        <h4 class="h3 fw-bold mb-4">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'icon_section.title_3'))) }}</h1>
                        </h4>
                        <p class="fs-5 text-muted">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'icon_section.subtitle_3'))) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
