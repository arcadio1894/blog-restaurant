<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-F8CPDCJ9WX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-F8CPDCJ9WX');
    </script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BLOG FUEGO Y MASA | La Mejor Pizza en Trujillo - Delivery Rápido y Delicioso</title>
    <meta name="description" content="Descubre las pizzas más deliciosas en Trujillo. FUEGO Y MASA ofrece delivery rápido, promociones irresistibles y calidad insuperable. ¡Haz tu pedido ahora!">
    <meta name="keywords" content="pizzas Trujillo, delivery pizza Trujillo, pizzerías en Trujillo, FUEGO Y MASA, mejor pizza Trujillo">
    <meta name="author" content="FUEGO Y MASA">
    <meta name="robots" content="index, follow">

    <!-- Open Graph para redes sociales -->
    <meta property="og:title" content="BLOG FUEGO Y MASA | La Mejor Pizza en Trujillo">
    <meta property="og:description" content="Disfruta las mejores pizzas en Trujillo. Delivery rápido y promociones exclusivas en FUEGO Y MASA. ¡Prueba el sabor que encanta!">
    <meta property="og:image" content="https://www.fuegoymasa.com/images/pizza-destacada.jpg">
    <meta property="og:url" content="https://www.fuegoymasa.com">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_PE">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="FUEGO Y MASA | La Mejor Pizza en Trujillo">
    <meta name="twitter:description" content="Haz tu pedido online en FUEGO Y MASA y disfruta de las mejores pizzas en Trujillo. ¡Promociones especiales todos los días!">
    <meta name="twitter:image" content="https://www.fuegoymasa.com/images/pizza-destacada.jpg">

    <title>{{ config('app.name', 'Sermeind') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/favicon.png') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    --}}
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />

    <style>
        /* footer section*/
        .footer_section {
            background-color: #222831;
            color: #ffffff;
            padding: 75px 0 40px 0;
            text-align: center;
            font-size: 1rem;
        }

        .footer_section h4 {
            font-size: 28px;
        }

        .footer_section h4,
        .footer_section .footer-logo {
            /*font-weight: 600;*/
            margin-bottom: 20px;
            font-family: 'League Gothic', cursive;
        }

        .footer_section p {
            color: #dbdbdb;
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .footer_section .footer-col {
            margin-bottom: 30px;
        }

        .footer_section .footer_contact .contact_link_box {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .footer_section .footer_contact .contact_link_box a {
            margin: 5px 0;
            color: #ffffff;
        }

        .footer_section .footer_contact .contact_link_box a i {
            margin-right: 5px;
        }

        .footer_section .footer_contact .contact_link_box a:hover {
            color: #ffbe33;
        }

        .footer_section .footer-logo {
            display: block;
            /*font-weight: bold;*/
            font-size: 38px;
            line-height: 1;
            color: #ffffff;
        }

        .footer_section .footer_social {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .footer_section .footer_social a {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            color: #222831;
            width: 30px;
            height: 30px;
            border-radius: 100%;
            background-color: #ffffff;
            border-radius: 100%;
            margin: 0 2.5px;
            font-size: 18px;
        }

        .footer_section .footer_social a:hover {
            color: #ffbe33;
        }

        .footer_section .footer-info {
            text-align: center;
            margin-top: 25px;
        }

        .footer_section .footer-info p {
            color: #ffffff;
            margin: 0;
        }

        .footer_section .footer-info p a {
            color: inherit;
        }
    </style>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('/') }}">Blog Fuego y Masa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ url('/') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('welcome.about') }}">Nosotros</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link px-lg-3 py-3 py-lg-4">Dashboard</a>
                        </li>
                    @else
                        {{--<li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link px-lg-3 py-3 py-lg-4">Log in</a>
                        </li>--}}
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link px-lg-3 py-3 py-lg-4">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- Page Header-->
<header class="masthead" style="background-image: url('{{ asset('template/assets/img/pizza-and-vegetables-on-dark-kitchen-backdrop-vector.jpg') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Bienvenido a Fuego y Masa</h1>
                    <span class="subheading">"Una pizza, mil recuerdos compartidos."</span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <div id="body-table">

            </div>
            <!-- Post preview-->
            {{--@foreach( $posts as $post )
                @php
                    $fecha = \Carbon\Carbon::parse($post->date_posted)->translatedFormat('j \\d\\e F \\d\\e Y \\a \\l\\a\\s g:i A');
                @endphp
                <div class="post-preview">
                    <a href="{{ route('post.show', ['slug' => $post->slug]) }}">
                        <h2 class="post-title">{{ $post->title }}</h2>
                        <h3 class="post-subtitle">{{ $post->idea }}</h3>
                    </a>
                    <p class="post-meta">
                        Publicado por
                        <a href="#!">{{$post->user->name }}</a>
                        el {{ $fecha }}
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
            @endforeach--}}
            <!-- Pager-->
            <div class="d-flex justify-content-between mb-4" id="pagination"></div>
        </div>
    </div>
</div>

<template id="previous-page">
    <div><a class="btn btn-primary text-uppercase" href="#!" id="pagePrev" data-page="">&larr; Publicaciones anteriores </a></div>
</template>

<template id="next-page">
    <div><a class="btn btn-primary text-uppercase" href="#!" id="pageNext" data-page="">Más publicaciones →</a></div>
</template>

<template id="item-post">
    <div>
        <div class="post-preview">
            <a data-url href="{{--{{ route('post.show', ['slug' => $post->slug]) }}--}}">
                <h2 class="post-title" data-title>{{--{{ $post->title }}--}}</h2>
                <h3 class="post-subtitle" data-subtitle>{{--{{ $post->idea }}--}}</h3>
            </a>
            <p class="post-meta" data-posted>
                Publicado por
                <a href="#!" >{{--{{$post->user->name }}--}}</a>
                {{--el {{ $fecha }}--}}
            </p>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
    </div>
</template>
<!-- Footer-->
<footer class="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-col">
                <div class="footer_contact">
                    <h4>
                        Contáctanos
                    </h4>
                    <div class="contact_link_box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                        Trujillo
                                    </span>
                        </a>
                        <a href="https://wa.me/51906343258?text=Hola%20FUEGO%20Y%20MASA,%20quiero%20comprar%20una%20pizza.%20%F0%9F%8D%95" target="_blank">
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                            <span>
                                        Whatsapp  906-343-258
                                    </span>
                        </a>
                        <a href="mailto:fuegoymasaperu@gmail.com" target="_blank">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                        fuegoymasaperu@gmail.com
                                    </span>
                        </a>
                        <a href="https://www.fuegoymasa.com/reclamaciones" target="_blank">
                            <img src="{{ asset('template/assets/libro_reclamaciones.webp') }}" alt="libro_reclamaciones" style="width: 100px;" >

                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 footer-col">
                <div class="footer_detail">
                    <a href="" class="footer-logo">
                        Fuego y Masa
                    </a>
                    <p>
                        Encendemos la pasión en cada creación, con ingredientes frescos y dedicación, para llevar calidad y sabor a cada mesa.
                    </p>
                    <div class="footer_social">
                        <a href="https://www.facebook.com/people/Fuego-y-Masa/61568065745757/" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href=" https://www.linkedin.com/company/fuego-y-masa" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.instagram.com/fuegoymasaperu/" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/51906343258?text=Hola%20FUEGO%20Y%20MASA,%20quiero%20comprar%20una%20pizza.%20%F0%9F%8D%95" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.tiktok.com/@fuegoymasa" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="enable-background:new 0 0 456.029 456.029;padding: 7px;">
                                <path d="M448,209.2c-5.4,0.5-10.8,0.8-16.2,0.8c-55.3,0-102.4-36.2-118.8-85.5v204c0,65.4-53,118.4-118.4,118.4c-65.4,0-118.4-53-118.4-118.4c0-63.1,49.3-114.6,111.4-118.2v62.6c-27.3,3.4-48.4,26.7-48.4,55.6c0,30.8,25,55.8,55.8,55.8c30.8,0,55.8-25,55.8-55.8V0h62.6c8.5,59,58.6,104.7,118.4,104.7V209.2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 footer-col">
                <h4>
                    Horarios
                </h4>
                <p>
                    Lunes a Viernes
                </p>
                <p>
                    6:30 PM - 11:30 PM
                </p>

                <p>
                    Sábados y Domingos
                </p>
                <p>
                    4:00 PM - 11:30 PM
                </p>

            </div>
        </div>
        <div class="footer-info">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="https://edesce.com/">EDESCE</a><br><br>
                &copy; <span id="displayYear"></span> Distributed By
                <a href="https://edesce.com/" target="_blank">EDESCE</a>
            </p>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Core theme JS-->
<script src="{{ asset('template/js/scripts.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/welcome/welcome.js') }}?v={{ time() }}"></script>
</body>
</html>
