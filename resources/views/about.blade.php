@extends('layouts.appBlog')

@section('header')
    <header class="masthead" style="background-image: url({{ asset('template/assets/img/2small-about-bg.jpg') }})">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Nosotros</h1>
                        <span class="subheading">¿Quienes somos?</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>¡Hola! Soy Remso y te doy la bienvenida a nuestro blog de tecnología independiente. Aquí, encontrarás un enfoque profesional y empresarial sobre las últimas tendencias y desarrollos en el mundo tecnológico. Nos dedicamos a proporcionarte la información más relevante y actualizada para ayudarte a llevar tu organización al siguiente nivel. Exploramos innovaciones, analizamos soluciones tecnológicas y ofrecemos consejos prácticos para optimizar tus procesos empresariales. Nuestro objetivo es ser tu fuente confiable de conocimiento y guía en este dinámico y siempre cambiante ámbito tecnológico.</p>
                <p>Para conocer más sobre mi trayectoria profesional, te invito a visitar mi perfil en <a href="https://www.linkedin.com/in/remso-ivan-rojas-guevara-a5382912a/" target="_blank">LinkedIn</a> </p>
            </div>
        </div>
    </div>
@endsection
