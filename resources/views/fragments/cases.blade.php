@php
    use App\Helpers\BladeTranslator;
@endphp
<div id="cases-page">
    <section class="header">
        <div class="p-3 p-md-5">
            <div class="container-fluid py-5">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-12 col-md-10 text-center">
                        <h1 class="display-3 fw-bold mb-4 text-center" data-aos="fade-left">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'cases_section.header_title'))) }}
                        </h1>
                        <p class="fs-5 text-muted pb-5" data-aos="fade-right">
                            {{ ucfirst(BladeTranslator::__(data_get($pageAttributes, 'cases_section.header_description'))) }}
                        </p>
                        <div class="case-card-items" data-aos="fade-up">
                            @foreach (data_get($pageAttributes, 'cases_section.cases', []) as $case)
                                <div class="case-card">
                                    <h4> {{ ucfirst(BladeTranslator::__(data_get($case, 'meta.title'))) }}</h4>
                                    <a class="case-card-content" href="{{ data_get($case, 'meta.url') }}"
                                        target="_blank" style="--case-image:url('{{ data_get($case, 'url') }}')">
                                        <div class="overlay-eye">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
