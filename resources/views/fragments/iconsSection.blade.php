@php
    use App\Helpers\BladeTranslator;
@endphp
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
