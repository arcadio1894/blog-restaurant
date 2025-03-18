@extends('layouts.appBlog')

@section('title', 'BLOG | Nosotros')

@section('header')
    <header class="masthead" style="background-image: url({{ asset('template/assets/img/pizza-and-vegetables-on-dark-kitchen-backdrop-vector.jpg') }})">
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
                <h2 class="text-center">
                    Fuego y Masa
                </h2>
                <p>
                    En Fuego y Masa, somos una pizzería orgullosamente trujillana, apasionada por crear momentos inolvidables a través de sabores únicos.
                </p>

                <p>
                    Nuestro <b>objetivo</b> no es solo ofrecerte las pizzas clásicas que amas,
                    sino también sorprenderte con experiencias gastronómicas que despierten tus sentidos y redefinan lo que significa disfrutar de una pizza.
                </p>

                <p>
                    Sabemos que las mejores historias comienzan en casa, y por eso llevamos nuestros sabores directamente a tu puerta.
                    Cada pizza está elaborada con ingredientes cuidadosamente seleccionados y una dedicación que garantiza calidad en cada bocado.
                    Queremos ser parte de tus momentos especiales, esos que compartes con familia, amigos o simplemente contigo mismo.
                </p>

                <p>
                    Porque en Fuego y Masa, creemos que una pizza es más que comida, es el puente hacia recuerdos inolvidables.
                </p>

                <p style="text-align: center;" >
                    <b>"Una pizza, mil recuerdos compartidos."</b>
                </p>
            </div>
        </div>
    </div>
@endsection
