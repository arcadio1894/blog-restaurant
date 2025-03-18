@extends('layouts.appPost')

@section('title', $post->title)

@section('contentDescriptionTag', $post->idea)

@section('contentAuthorTag', $post->user->name)

@section('contentKeywordsTag', $post->keywords)

@section('contentOGTitleTag', $post->title)

@section('contentOGDescriptionTag', $post->idea)

@section('contentTWTitleTag', $post->title)

@section('contentTWTitleTag', $post->idea)

@section('styles')

@endsection

@section('header')
    <header class="masthead" style="background-image: url({{ asset('images/posts/'.$post->image) }})">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="post-heading">
                        @php
                            $fecha = \Carbon\Carbon::parse($post->date_posted)->translatedFormat('j \\d\\e F \\d\\e Y \\a \\l\\a\\s g:i A');
                        @endphp
                        <h1>{{ $post->title }}</h1>
                        <h2 class="subheading">{{ $post->idea }}</h2>
                        <span class="meta" style="font-size: 1rem !important;">
                            Publicado por
                            <a href="#!">{{$post->user->name }}</a>
                            el {{ $fecha }}
                        </span>

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
                <div><i class="fa fa-tags"></i> Tags:
                    @foreach( $tags as $tag )
                        <a href=""><span class="badge badge-info" style="color: #000000">{{ $tag->tag }}</span></a>
                    @endforeach
                </div>
                @foreach ($arraySections as $section)
                    @if ($section['type'] === 'description')
                        <p class="text_description_show">{!! $section['text_description'] !!}</p>
                    @elseif ($section['type'] === 'title')
                        <h2 class="section-heading">{{ $section['title'] }}</h2>
                    @elseif ($section['type'] === 'image')
                        <div class="text-center">
                            <a href="#!"><img class="img-fluid mx-auto" src="{{ asset('images/postImages/'.$section['name']) }}" alt="{{ $section['description'] }}" /></a>
                            <span class="caption text-muted">{{ $section['description'] }}</span>
                        </div>
                    @elseif ($section['type'] === 'video')
                        @php
                            function getYoutubeVideoId($url) {
                                // Extraer el ID del video de YouTube desde la URL
                                parse_str(parse_url($url, PHP_URL_QUERY), $params);
                                return isset($params['v']) ? $params['v'] : null;
                            }

                            $youtubeUrl = $section['url'];
                            $videoId = getYoutubeVideoId($youtubeUrl);
                        @endphp

                        <div class="text-center">
                            @if ($videoId)
                                <iframe width="460" height="315" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                            @else
                            <!-- Manejo de caso donde la URL no es válida o no se puede extraer el ID -->
                                <p>No se pudo cargar el video desde la URL: {{ $youtubeUrl }}</p>
                            @endif
                            <br>
                            <span class="caption text-muted">{{ $section['description'] }}</span>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
@endsection
