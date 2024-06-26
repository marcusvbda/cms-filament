@php
    use App\Models\Language;
    $languages = Language::get();
    $currentLocale = app()->getLocale();
    if (!$currentLocale) {
        $currentLocale = @$languages[0]->code ?? 'en';
        session()->put('locale', $currentLocale);
    }
    $currentYear = date('Y');

    function getActiveClass($path)
    {
        return request()->path() === $path ? 'active' : '';
    }

    $twitterUrl = data_get($siteAttributes, 'site_component_default.twitter_url');
    $linkedinUrl = data_get($siteAttributes, 'site_component_default.linkedin_url');
    $instagramUrl = data_get($siteAttributes, 'site_component_default.instagram_url');

    $siteTitle = data_get($siteAttributes, 'site_component_default.site_title');
    $siteDescription = data_get($siteAttributes, 'site_component_default.site_description');
    $favicon = data_get($siteAttributes, 'site_component_default.favicon.url');
@endphp

<!doctype html>
<html lang={{ str_replace('_', '-', $currentLocale) }}>

<head>
    <meta name="title" content="{{ $siteTitle }} | @yield('title')">
    <meta property="og:title" content="{{ $siteTitle }} | @yield('title')">
    <meta name="description" content="@yield('description', $siteDescription)">
    <meta property="og:description" content="@yield('description', $siteDescription)">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <title>Gravity labs | @yield('title')</title>
    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img loading="lazy" src="{{ data_get($siteAttributes, 'site_component_default.logo.url') }}"
                        width="163" alt="logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ getActiveClass('/') }}"
                                href="#">{{ ucfirst(Language::__('home')) }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ getActiveClass('cases') }}"
                                href="#cases">{{ ucfirst(Language::__('cases')) }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ getActiveClass('contact') }}"
                                href="#contact">{{ ucfirst(Language::__('contact')) }}</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex align-center ms-5 gap-3 language-selector">
                    <ul class="navbar-nav ms-auto mb-lg-0">
                        @foreach ($languages as $language)
                            <li class="nav-item">
                                <a class="nav-link {{ $currentLocale == $language->code ? 'active' : '' }}"
                                    href="{{ route('set-language', ['lang' => $language->code]) }}">
                                    <img loading="lazy" src="{{ Storage::url($language->flag) }}"
                                        alt="{{ $language->name }}" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <div class="container">
        <footer class="py-5">
            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                <p>© {{ $currentYear }}. {{ ucfirst(Language::__('all rights reserved')) }}.</p>
                <ul class="list-unstyled d-flex">
                    @if ($twitterUrl)
                        <li class="ms-3">
                            <a class="link-dark twitter-x" href="{{ $twitterUrl }}" aria-label="twitter-x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                    <path
                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                                </svg>
                            </a>
                        </li>
                    @endif
                    @if ($linkedinUrl)
                        <li class="ms-3">
                            <a class="link-dark linkedin" href="{{ $linkedinUrl }}" aria-label="linkedin">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                </svg>
                            </a>
                        </li>
                    @endif
                    @if ($instagramUrl)
                        <li class="ms-3">
                            <a class="link-dark instagram" href="{{ $instagramUrl }}" aria-label="instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </footer>
    </div>
</body>

</html>


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
