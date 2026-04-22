<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <title>Cadastral and Geo-data Pillar Analysis</title>

    <style>
        .survey-logo-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(135deg, #0d6efd, #198754);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .25);
        }

        .survey-logo-icon svg {
            width: 28px;
            height: 28px;
        }

        .main-nav .nav {
            align-items: center;
            gap: 20px;
        }

        .main-nav .nav a {
            font-weight: 500;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-breezed.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">

</head>

<body>

    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav d-flex justify-content-between align-items-center">

                        <a href="javascript:void(0)" class="logo d-flex align-items-center">
                            <div class="survey-logo-icon">
                                <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="32" cy="20" r="10" stroke="white" stroke-width="3" />
                                    <line x1="32" y1="30" x2="32" y2="44" stroke="white"
                                        stroke-width="3" />
                                    <line x1="20" y1="44" x2="44" y2="44" stroke="white"
                                        stroke-width="3" />
                                    <line x1="24" y1="44" x2="18" y2="56" stroke="white"
                                        stroke-width="3" />
                                    <line x1="40" y1="44" x2="46" y2="56" stroke="white"
                                        stroke-width="3" />
                                    <line x1="32" y1="44" x2="32" y2="58" stroke="white"
                                        stroke-width="3" />
                                </svg>
                            </div>
                        </a>

                        <ul class="nav">

                            @if (Route::has('login'))
                                @auth
                                    <x-app-layout></x-app-layout>
                                @else
                                    <li><a href="{{ route('login') }}">Login</a></li>

                                    @if (Route::has('register'))
                                        {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                                    @endif
                                @endauth
                            @endif

                        </ul>

                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>

                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div id="search">
        <button type="button" class="close">×</button>
        <form id="contact" action="#" method="get">
            <fieldset>
                <input type="search" name="q" placeholder="SEARCH KEYWORD(s)">
            </fieldset>
            <fieldset>
                <button type="submit" class="main-button">Search</button>
            </fieldset>
        </form>
    </div>

    <div class="main-banner header-text" id="top">
        <div class="Modern-Slider">

            <div class="item">
                <div class="img-fill">
                    <img src="assets/images/slide-01.jpg" alt="">
                    <div class="text-content">
                        <h5>Cadastral and Geo-data Pillar Analysis</h5>
                        <a href="{{ route('login') }}" class="main-stroked-button">WELCOME</a>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="img-fill">
                    <img src="assets/images/slide-02.jpg" alt="">
                    <div class="text-content">
                        <h5>Cadastral and Geo-data Pillar Analysis</h5>
                        <a href="{{ route('login') }}" class="main-stroked-button">WELCOME</a>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="img-fill">
                    <img src="assets/images/slide-03.jpg" alt="">
                    <div class="text-content">
                        <h5>Cadastral and Geo-data Pillar Analysis</h5>
                        <a href="{{ route('login') }}" class="main-stroked-button">WELCOME</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="left-text-content"></div>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>
