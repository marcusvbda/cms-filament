<div class="d-flex align-center ms-5 gap-3 language-selector">
    <ul class="navbar-nav ms-auto mb-lg-0">
        <li class="nav-item ">
            <a class="nav-link {{ $currentLocale == 'en' ? 'active' : '' }}" aria-current="page"
                href="{{ route('set-language', ['lang' => 'en']) }}">
                <img loading="lazy" src="{{ asset('images/flags/usa.png') }}" alt="EN" />
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $currentLocale == 'pt_BR' ? 'active' : '' }}" aria-current="page"
                href="{{ route('set-language', ['lang' => 'pt_BR']) }}">
                <img loading="lazy" src="{{ asset('images/flags/brazil.png') }}" alt="BR" />
            </a>
        </li>
    </ul>
</div>
