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
    <meta name="description" content="Descubre cómo elegir el ERP adecuado para tu empresa en Perú y cuánto cuesta implementarlo. Comparación de costos de ERP y SAP.">
    <meta name="keywords" content="elegir ERP, costo implementar ERP, costo SAP, ERP en Perú, soluciones ERP, software empresarial en Perú">
    <meta name="robots" content="index, follow">
    <meta name="author" content="EDESCE">
    <meta name="language" content="es-ES">
    <meta name="canonical" content="https://blog.edesce.com/post/cual-erp-elegir-cuanto-cuesta-implementar-un-erp-cuanto-cuesta-sap">

    <meta property="og:title" content="¿Cuál ERP elegir? ¿Cuánto cuesta implementar un ERP en Perú? ¿Cuánto cuesta SAP?">
    <meta property="og:description" content="Descubre cómo elegir el ERP adecuado para tu empresa en Perú y cuánto cuesta implementarlo. Comparación de costos de ERP y SAP.">
    <meta property="og:image" content="https://blog.edesce.com/images/postImages/2_15.jpg">
    <meta property="og:url" content="https://blog.edesce.com/post/cual-erp-elegir-cuanto-cuesta-implementar-un-erp-cuanto-cuesta-sap">

    <meta name="twitter:title" content="¿Cuál ERP elegir? ¿Cuánto cuesta implementar un ERP en Perú? ¿Cuánto cuesta SAP?">
    <meta name="twitter:description" content="Descubre cómo elegir el ERP adecuado para tu empresa en Perú y cuánto cuesta implementarlo. Comparación de costos de ERP y SAP.">
    <meta name="twitter:image" content="https://blog.edesce.com/images/postImages/2_15.jpg">
    <meta name="twitter:card" content="summary_large_image">

    <title>{{ config('app.name', 'Sermeind') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/tec.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    --}}
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ url('/') }}">Blog Tech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ url('/') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('welcome.about') }}">About</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link px-lg-3 py-3 py-lg-4">Home</a>
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
<header class="masthead" style="background-image: url('{{ asset('template/assets/img/2small-about-bg.jpg') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Todo sobre tecnología</h1>
                    <span class="subheading">Noticias , reseñas, críticas y más ...</span>
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
    <div><a class="btn btn-primary text-uppercase" href="#!" id="pagePrev" data-page="">&larr; Newer Posts </a></div>
</template>

<template id="next-page">
    <div><a class="btn btn-primary text-uppercase" href="#!" id="pageNext" data-page="">Older Posts →</a></div>
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
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://www.facebook.com/EDESCE" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.youtube.com/@edesceeirl9656" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.linkedin.com/in/remso-ivan-rojas-guevara-a5382912a/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-linkedin fa-stack-1x fa-inverse"></i>
                                    </span>
                        </a>
                    </li>                   
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy; <a href="https://www.edesce.com/">EDESCE</a> 2024</div>
            </div>
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
