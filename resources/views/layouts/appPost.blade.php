<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="@yield('contentDescriptionTag')" />
    <meta name="author" content="@yield('contentAuthorTag')" />
    <meta name="keywords" content="@yield('contentKeywordsTag')" />
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="@yield('contentOGTitleTag')">
    <meta property="og:description" content="@yield('contentOGDescriptionTag')">
    {{--<meta property="og:image" content="@yield('contentOGDescriptionTag')">
    <meta property="og:url" content="URL de la página">--}}
    <meta property="og:type" content="website">
    {{--<meta name="twitter:card" content="summary_large_image">--}}
    <meta name="twitter:title" content="@yield('contentTWTitleTag')">
    <meta name="twitter:description" content="@yield('contentTWTitleTag')">
    {{--<meta name="twitter:image" content="URL de la imagen de vista previa">
    <meta name="twitter:site" content="@tu_usuario_de_twitter">--}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/favicon.png') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
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
    @yield('styles')
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
                @guest
                    @if (Route::has('login'))
                        {{--<li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>--}}
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!-- Page Header-->
@yield('header')
{{--<header class="masthead2" style="background-image: url({{ asset('template/assets/img/contact-bg.jpg') }});">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="page-heading">
                    <h1>Contact Me</h1>
                    <span class="subheading">Have questions? I have answers.</span>
                </div>
            </div>
        </div>
    </div>
</header>--}}
<!-- Main Content-->

<article class="mb-4">
    @yield('content')
    {{--<div class="container px-4 px-lg-5">

        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                <div class="my-5">
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <div class="form-floating">
                            <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Name</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="phone" type="tel" placeholder="Enter your phone number..." data-sb-validations="required" />
                            <label for="phone">Phone Number</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" id="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                        <br />
                        <!-- Submit success message-->
                        <!---->
                        <!-- This is what your users will see when the form-->
                        <!-- has successfully submitted-->
                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <!-- Submit error message-->
                        <!---->
                        <!-- This is what your users will see when there is-->
                        <!-- an error submitting the form-->
                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                        <!-- Submit Button-->
                        <button class="btn btn-primary text-uppercase disabled" id="submitButton" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>--}}
</article>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('template/js/scripts.js') }}"></script>
<script>
    getYear();
    function getYear() {
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        document.querySelector("#displayYear").innerHTML = currentYear;
    }

</script>
@yield('scripts')
</body>
</html>
