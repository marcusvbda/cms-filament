<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('/images/logo.png') }}" width="163" alt="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Shop</a>
                </li> --}}
            </ul>
            {{-- <div class="d-flex align-center ms-5 gap-3">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">SignIn</a>
                    </li>
                </ul>
                <button class="btn btn-primary">SignUp</button>
            </div> --}}
        </div>
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
