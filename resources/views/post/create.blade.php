@extends('layouts.appAdmin')

@section('title')
    Crear Post
@endsection

@section('openAdmin', 'menu-open')

@section('activeAdmin', 'active')

@section('activeCreatePost', 'active')

@section('styles-plugins')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endsection

@section('styles')
    <style>
        #preview_title {
            font-size: 2.5rem;
            margin-top: 0;
            margin-bottom: 0.5rem;
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 800;
            line-height: 1.2;
        }

        #preview_subtitle {
            font-size: 1.675rem;
            font-weight: 600;
            margin: 0.75rem 0 2rem;
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        #preview_posted {
            font-size: 1rem;
            font-weight: 300;
            font-style: italic;
            font-family: "Lora", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        .preview_description p {
            font-size: 16px !important;
            margin: 0.5rem 0px !important;
        }

        .preview_subtitle {
            font-size: 1.85rem;
            font-weight: 700;
            margin-top: 2rem;
        }

        .caption {
            font-size: 0.875rem;
            font-style: italic;
            display: block;
            margin: 0;
            padding: 0.625rem;
            text-align: center;
        }
    </style>
@endsection

@section('page-header')
    <h1 class="page-title">Crear Post</h1>
@endsection

@section('page-breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('post.index') }}"><i class="fa fa-archive"></i> Publicaciones</a>
        </li>
        <li class="breadcrumb-item"><i class="fa fa-plus-circle"></i> Crear Post</li>
    </ol>
@endsection

@section('page-title')
    <h5 class="card-title">CREACIÓN DE POST</h5>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <form class="form-horizontal">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-3 col-form-label">Categoría</label>
                        <div class="col-sm-9">
                            <select id="category_id" class="form-control select2" name="category_id" data-states style="width: 100%;">
                                <option></option>
                                @foreach( $categories as $category )
                                <option value="{{$category->id}}">{{ $category->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="banner" class="col-sm-3 col-form-label">Banner</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="form-control" id="banner" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Título</label>
                        <div class="col-sm-9">
                            <textarea id="title" spellcheck="true" lang="es" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idea" class="col-sm-3 col-form-label">Idea Principal</label>
                        <div class="col-sm-9">
                            <textarea id="idea" spellcheck="true" lang="es" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tag-input" class="col-sm-3 col-form-label">Tags</label>
                        <div class="input-group col-md-9">
                            <input type="text" spellcheck="true" lang="es" id="tag-input" class="form-control">
                            <div class="input-group-append">
                                <button id="add-tag" class="btn btn-primary btn-block">Agregar</button>
                            </div>
                        </div>

                    </div>
                    <div class="row offset-3" id="tags-container"></div>
                    <div id="sections-container"></div>
                    <div class="form-group row float-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">Agregar sección</button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                                <div class="dropdown-menu" role="menu" style="">
                                    <a class="dropdown-item" href="#" id="add_subtitle">Subtitulo</a>
                                    <a class="dropdown-item" href="#" id="add_description">Descripción</a>
                                    <a class="dropdown-item" href="#" id="add_image">Imagen</a>
                                    <a class="dropdown-item" href="#" id="add_video">Video</a>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" data-url="{{ route('post.store') }}" id="btn-submit" class="btn btn-success float-right">Guardar Publicación</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Preview</div>
            @php
                \Carbon\Carbon::setLocale('es');
                $fecha = \Carbon\Carbon::now()->translatedFormat('j \\d\\e F \\d\\e Y \\a \\l\\a\\s g:i A');
            @endphp
            <div class="card-body" >
                <div class="row" >
                    <div id="preview"></div>
                    <div class="post-heading">
                        <h1 class="col-md-12" id="preview_title"></h1>
                        <h2 class="col-md-12 mb-3" id="preview_subtitle"></h2>
                        <span class="col-md-12 " id="preview_posted">
                            Publicado por
                            <a href="#!">{{ Auth::user()->name }}</a>
                            el {{ $fecha }}
                        </span>
                    </div>
                </div>
                <div class="row" id="sections-preview">

                </div>
            </div>
        </div>
    </div>
</div>

<template id="template-tag">
    <div class="input-group col-md-6 input-group-sm mb-2">
        <input type="text" data-text class="form-control" readonly>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary remove-tag" type="button" >X</button>
        </div>
    </div>
</template>

<template id="template-description">

    <div class="card card-primary" data-section="description" data-id_section="">
        <div class="card-header">
            <h3 class="card-title">Sección Descripción</h3>
            <div class="card-tools">
                <a class="btn btn-danger btn-sm" data-remove_section data-toggle="tooltip" title="Quitar">
                    <i class="fas fa-check-square"></i> Eliminar sección
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group row" >
                <div class="col-sm-12">
                    <textarea spellcheck="true" lang="es" class="textarea_edit" data-text_description style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>


</template>

<template id="template-preview_description">
    <div class="col-md-12 preview_description" data-id_preview_description></div>
</template>

<template id="template-image">
    <div class="card card-primary" data-section="image" data-id_section="">
        <div class="card-header">
            <h3 class="card-title">Sección Imagen</h3>
            <div class="card-tools">
                <a class="btn btn-danger btn-sm" data-remove_section data-toggle="tooltip" title="Quitar">
                    <i class="fas fa-check-square"></i> Eliminar sección
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group row">
                <label for="banner" class="col-sm-3 col-form-label">Imagen</label>
                <div class="col-sm-9">
                    <input type="file" data-image class="form-control" accept="image/*">
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Comentario</label>
                <div class="col-sm-9">
                    <textarea class="form-control" data-comment_image rows="3" placeholder="Enter ..."></textarea>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</template>

<template id="template-preview_image">
    <div class="col-md-12 preview_image text-center" data-id_preview_image>
        <a href="#!"><img class="img-fluid mx-auto" data-url_image src="" alt="..."></a><br>
        <span class="caption text-muted" data-comment_image></span>
    </div>
</template>

<template id="template-subtitle">
    <div class="card card-primary" data-section="subtitle" data-id_section="">
        <div class="card-header">
            <h3 class="card-title">Sección Subtítulo</h3>
            <div class="card-tools">
                <a class="btn btn-danger btn-sm" data-remove_section data-toggle="tooltip" title="Quitar">
                    <i class="fas fa-check-square"></i> Eliminar sección
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea spellcheck="true" lang="es" class="form-control" data-text_subtitle rows="3" placeholder="Enter ..."></textarea>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</template>

<template id="template-preview_subtitle">
    <div class="col-md-12 preview_subtitle" data-id_preview_subtitle></div>
</template>

<template id="template-video">
    <div class="card card-primary" data-section="video" data-id_section="">
        <div class="card-header">
            <h3 class="card-title">Sección Video</h3>
            <div class="card-tools">
                <a class="btn btn-danger btn-sm" data-remove_section data-toggle="tooltip" title="Quitar">
                    <i class="fas fa-check-square"></i> Eliminar sección
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group row">
                <label for="banner" class="col-sm-3 col-form-label">Link de Youtube</label>
                <div class="col-sm-9">
                    <textarea spellcheck="true" lang="es" class="form-control" data-text_video rows="3" placeholder="Enter ..."></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Comentario</label>
                <div class="col-sm-9">
                    <textarea class="form-control" data-comment_video rows="3" placeholder="Enter ..."></textarea>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</template>

<template id="template-preview_video">
    <div class="col-md-12 preview_video text-center" data-id_preview_video>
        <!-- Aqui quiero que este el preview del video -->
        <div data-preview_video></div>
        <span class="caption text-muted" data-comment_video></span>
    </div>
</template>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/summernote/lang/summernote-es-ES.js')}}"></script>
    <script>
        $(function () {

            $('.textarea_edit').summernote({
                lang: 'es-ES',
                placeholder: 'Ingrese los detalles',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link']],
                    ['view', ['codeview', 'help']]
                    /*['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]*/
                ],
                callbacks: {
                    onPaste: function(e) {
                        // Acceder al texto del portapapeles
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                        // Prevenir la acción de pegado predeterminada
                        e.preventDefault();

                        // Insertar el texto sin formato en Summernote
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
            //Initialize Select2 Elements
            $('#category_id').select2({
                placeholder: "Selecione Categoría",
            });

        })
    </script>
    <script src="{{ asset('js/blog/create.js') }}?v={{ time() }}"></script>
@endsection
