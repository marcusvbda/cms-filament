{{-- @props(['items' => [], 'indicators' => true, 'controls' => true, 'interval' => 5000])

@php
    $carouselId = uniqid();
@endphp

<div id="{{ $carouselId }}" class="carousel carousel-dark slide"
    @if ($interval) data-bs-ride="carousel" data-bs-interval="{{ $interval }}" @endif>
    <div class="carousel-indicators">
        @foreach ($items as $index => $item)
            <button @if (!$indicators) style="display: none;" @endif type="button"
                data-bs-target="#{{ $carouselId }}" data-bs-slide-to="{{ $index }}"
                class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($items as $index => $item)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                {!! $item !!}
            </div>
        @endforeach
    </div>
    <button @if (!$controls) style="display: none;" @endif class="carousel-control-prev" type="button"
        data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button @if (!$controls) style="display: none" @endif class="carousel-control-next" type="button"
        data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> --}}



<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">Slide 1</div>
        <div class="swiper-slide">Slide 2</div>
        <div class="swiper-slide">Slide 3</div>
        ...
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
</div>

<script type="module">
    const swiper = new Swiper(".swiper")
</script>
