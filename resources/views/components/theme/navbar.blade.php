@php
    use App\Helpers\BladeTranslator;
    $currentLocale = app()->getLocale() ?? 'en';

    function getActiveClass($path)
    {
        return request()->path() === $path ? 'active' : '';
    }
@endphp

<nav class="navbar navbar-expand-lg bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img loading="lazy" src="{{ data_get($attributes, 'logo.url') }}" width="163"
                alt="{{ data_get($attributes, 'logo.meta.alt') }}" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ getActiveClass('/') }}"
                        href="/">{{ ucfirst(BladeTranslator::__('home')) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ getActiveClass('cases') }}"
                        href="/cases">{{ ucfirst(BladeTranslator::__('cases')) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ getActiveClass('team') }}"
                        href="/our-team">{{ ucfirst(BladeTranslator::__('our team')) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ getActiveClass('about') }}"
                        href="/about-us">{{ ucfirst(BladeTranslator::__('about us')) }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ getActiveClass('contact') }}"
                        href="/contact">{{ ucfirst(BladeTranslator::__('contact')) }}</a>
                </li>
            </ul>
        </div>
        @include('components.theme.language-selector', ['currentLocale' => $currentLocale])
    </div>
</nav>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menu = document.querySelector('.navbar');
        const scroll = () => {
            if (window.scrollY >= (menu.clientHeight / 1.5)) {
                menu.classList.add('shadow');
            } else {
                menu.classList.remove('shadow');
            }
        }

        document.addEventListener('scroll', scroll);
        scroll();
    });
</script>
