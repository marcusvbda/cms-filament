<section class="hero">
    <div class="p-3 p-md-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-10 text-center">
                    <h1 class="display-3 fw-bold mb-4 text-center">{{ data_get($attributes, 'hero_title') }}</h1>
                    <p class="fs-5 text-muted pb-5">{{ ucfirst(data_get($attributes, 'hero_subtitle')) }}</p>
                    <div class="form-group input-group my-5">
                        <input class="input-email form-control me-3" type="email"
                            placeholder="{{ ucfirst(data_get($attributes, 'hero_input_placeholder')) }}"
                            required="required">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg"
                                type="button">{{ ucfirst(data_get($attributes, 'hero_input_button')) }}</button>
                        </span>
                    </div>
                    @php
                        $items = [1];
                    @endphp
                    @component('_components.common.carousel', [
                        'items' => $items,
                        'indicators' => false,
                        'controls' => false,
                        'interval' => 5000,
                    ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</section>
