<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pietro @yield('title')</title>
    <meta name="title" content="Pietro">
    <meta name="apple-mobile-web-app-title" content="Pietro">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/icon-logo.png') }}" />


    <!-- opengraph -->
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="350">
    <meta property="og:image:height" content="350">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="Pietro">
    <meta property="og:title" content="Pietro" />
    <meta property="og:description" content="">
    <meta property="og:url" content="">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

</head>

<body>

    <!-- Header -->
    <header id="header">

        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="d-md-flex justify-content-center justify-content-md-end align-items-center">

                        <div class="nav-top col-sm-12 col-md-6 col-lg-6 d-flex justify-content-center justify-content-md-end mt-2 mt-md-0 me-md-5">
                            <span class="me-3"><i class="fas fa-phone-alt me-1"></i>(11) 2387-4001</span>
                            <span><i class="far fa-envelope me-1"></i> pietromultimarcas@hotmail.com</span>
                        </div>

                        <div class="nav-social-midias col-sm-12 col-md-2 col-lg-1 d-flex justify-content-center justify-content-md-end">
                            <a class="me-1 px-2 py-3" href=""><i class="fab fa-whatsapp"></i></a>
                            <a class="me-1 px-2 py-3" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="me-1 px-2 py-3" href=""><i class="fab fa-instagram"></i></a>
                            <a class="me-1 px-2 py-3" href=""><i class="fas fa-at"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-nav">

            <div class="container">

                <div class="wrap">

                    <div class="logo">
                        @if (route('home'))
                            <a href="{{ route('home') }}" class="logo-main"><img
                                    src="{{ asset('assets/images/logo-pietro.png') }}" alt=""></a>
                        @else
                            <a href="{{ route('home') }}" class="logo-main"><img class="img-fluid"
                                    src="{{ asset('assets/images/logo-pietrop.png') }}" alt=""></a>
                        @endif
                        <a href="{{ route('home') }}" class="logo-fix"><img class="img-fluid"
                                src="{{ asset('assets/images/logo-pietro.png') }}" alt=""></a>
                    </div>

                    <div class="menu">

                        <nav class="nav">

                            <ul>

                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('veiculos.*') ? 'active' : '' }}"
                                        href="{{ route('veiculos.index') }}">Veículos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('quemsomos.index') ? 'active' : '' }}"
                                        href="{{ route('quemsomos.index') }}">Sobre Nós</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('') ? 'active' : '' }}"
                                        href="{{ route('home') }}">Financiamento</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('') ? 'active' : '' }}"
                                        href="{{ route('home') }}">Venda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('contato.index') ? 'active' : '' }}"
                                        href="{{ route('contato.index') }}">Contato</a>
                                </li>

                            </ul>

                        </nav>

                    </div>

                    <div class="icon-sidemenu d-lg-none d-flex flex-grow-1 justify-content-end align-items-center">
                        <a href="javascript:void(0)" class="sidemenu_btn" id="sidemenu_toggle">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>

                </div>

            </div>

        </div>

        <!--Side Nav-->
        <div class="side-menu hidden">
            <div class="inner-wrapper">
                <span class="btn-close" id="btn_sideNavClose"><i></i></span>
                <nav class="side-nav w-100">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('veiculos.*') ? 'active' : '' }}"
                                href="{{ route('veiculos.index') }}">Veículos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('quemsomos.index') ? 'active' : '' }}"
                                href="{{ route('quemsomos.index') }}">Sobre Nós</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">Financiamento</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('contato.index') ? 'active' : '' }}"
                                href="{{ route('contato.index') }}">Contato</a>
                        </li>
                    </ul>
                </nav>

            </div>

        </div>

        <a id="close_side_menu" href="javascript:void(0);"></a>

    </header>
    <!-- Header -->


    <main role="main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="footer">

        <div class="footer-top py-5">

            <div class="container">

                <div class="row">

                    <div class="col-xs-12 col-md-6 col-lg-6">

                        <img class="img-fluid mb-4" src="{{ asset('assets/images/logo-branco-pietro.png') }}" alt="">

                        <p>A Pietro Multimarcas comercializa veículos multimarcas usados, de qualidade, revisados e com
                            garantia.<br>
                            Trabalhamos com seriedade e BONS PREÇOS.<br>
                            Aqui você faz um ÓTIMO NEGÓCIO! </p>

                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6">

                        <h3 class="mb-3">ENTRE EM CONTATO</h3>


                        <div class="row contact">

                            <div class="col-lg-4">

                                <div class="d-flex align-items-center mb-2">
                                    <i class="fab fa-whatsapp me-2"></i>
                                    <span>11 9597-04393</span>
                                </div>

                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone-alt me-2"></i>
                                    <span>11 2387-4001</span>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="d-flex align-items-center mb-2">
                                    <i class="far fa-envelope me-2"></i>
                                    <span>pietromultimarcas@hotmail.com</span>
                                </div>

                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <span>Avenida Do Cursino, 710<br>
                                        Vila Gumercindo - São Paulo - SP</span>
                                </div>

                            </div>

                        </div>


                        <div class="social-midias d-flex justify-content-start">
                            <a class="me-1 d-flex justify-content-center align-items-center" href=""><i
                                    class="fab fa-whatsapp"></i></a>
                            <a class="me-1 d-flex justify-content-center align-items-center" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="me-1 d-flex justify-content-center align-items-center" href=""><i
                                    class="fab fa-instagram"></i></a>
                            <a class="me-1 d-flex justify-content-center align-items-center" href=""><i
                                    class="fas fa-at"></i></a>
                        </div>
                    </div>




                </div>

            </div>

        </div>

        <div class="bottom-footer">

            <div class="container">

                <div class="clearfix">

                    <p class="col-sm-12 col-md-6 col-lg-6 copy">© {{ now()->year }} Pietro - Todos os
                        direitos
                        reservados</p>

                    <p class="col-sm-12 col-md-6 col-lg-6 dev">
                        Desenvolvido por <a href="https://www.agenciaaffinity.com.br"><img width="90"
                                src="https://agenciaaffinity.com.br/assinatura/affinity-logo-branco.svg"></a>
                    </p>

                </div>

            </div>

        </div>

    </footer>
    <!-- End Footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>


</body>

</html>
