<nav class="navbar navbar-expand-lg center-nav navbar-dark navbar-bg-dark">
    <div class="container flex-lg-row flex-nowrap align-items-center">
        <div class="navbar-brand w-100">
            <a href="./index.html">
                <img src="#" srcset="" alt="" />
            </a>
        </div>
        <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
            <div class="offcanvas-header d-lg-none">
                <h3 class="text-white fs-30 mb-0">Store Me</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Nav 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Nav 2</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Nav 3</a>
                    </li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="offcanvas-footer d-lg-none">
                    <div>
                        <a href="mailto:first.last@email.com" class="link-inverse">info@email.com</a>
                        <br /> 00 (123) 456 78 90 <br />
                        <nav class="nav social social-white mt-4">
                            <a href="#"><i class="uil uil-twitter"></i></a>
                            <a href="#"><i class="uil uil-facebook-f"></i></a>
                            <a href="#"><i class="uil uil-dribbble"></i></a>
                            <a href="#"><i class="uil uil-instagram"></i></a>
                            <a href="#"><i class="uil uil-youtube"></i></a>
                        </nav>
                        <!-- /.social -->
                    </div>
                </div>
                <!-- /.offcanvas-footer -->
            </div>
            <!-- /.offcanvas-body -->
        </div>
        <!-- /.navbar-collapse -->
        <div class="navbar-other w-100 d-flex ms-auto">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item"><a class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-search"><i class="fa fa-search"></i></a></li>
                <li class="nav-item">
                    <a class="nav-link position-relative d-flex flex-row align-items-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="badge badge-cart bg-primary">
                            5
                        </span>
                    </a>
                </li>
                <li class="nav-item d-lg-none">
                    <button class="hamburger offcanvas-nav-btn"><span></span></button>
                </li>
            </ul>
        </div>
    </div>
</nav>


{{-- CART --}}
<div class="offcanvas offcanvas-end bg-light" id="offcanvas-cart" data-bs-scroll="true">
    <div class="offcanvas-header">
        <h3 class="mb-0">Kosár</h3>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <div class="shopping-cart">

        </div>

        <div class="offcanvas-footer flex-column text-center">

            {{-- Alösszeg --}}
            <div class="d-flex w-100 justify-content-between mb-2">
                <span>Termékek nettó ára:</span>
                <span class="h6 mb-0">500</span>
            </div>

            {{-- Szállítási díj (opcionális megjelenítés) --}}
            <div class="d-flex w-100 justify-content-between mb-4">
                <span>Szállítási díj:</span>
                <span class="h6 mb-0">500</span>
            </div>

            {{-- VÉGÖSSZEG --}}
            <div class="d-flex w-100 justify-content-between mb-4">
                <span class="fw-bold">Végösszeg:</span>
                <span class="h4 mb-0 text-success">500</span>
            </div>

            {{-- Checkout Gomb --}}
            <a href="#" class="btn btn-primary btn-icon btn-icon-start rounded w-100 mb-4">
                <i class="fas fa-credit-card fs-18"></i> Tovább a Pénztárhoz
            </a>

            {{-- Opcionális üzenet --}}
            <p class="fs-14 mb-0">Ingyenes szállítás 500 felett</p>
        </div>

    </div>
</div>
{{-- CART END --}}

{{-- SEARCH BAR --}}
<div class="offcanvas offcanvas-top bg-light" id="offcanvas-search" data-bs-scroll="true">
    <div class="container d-flex flex-row py-6">
        <form class="search-form w-100">
            <input id="search-form" type="text" class="form-control" placeholder="Type keyword and hit enter">
        </form>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
</div>
{{-- SEARCH BAR END --}}
