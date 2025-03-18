@extends('layouts.appAdmin')

@section('title')
    Listar Post
@endsection

@section('openAdmin', 'menu-open')

@section('activeAdmin', 'active')

@section('activeListPost', 'active')

@section('styles-plugins')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.standalone.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.css') }}">

@endsection

@section('styles')
    <style>
        .select2-search__field{
            width: 100% !important;
        }
        .letraTabla {
            font-family: "Calibri", Arial, sans-serif; /* Utiliza Calibri si está instalado, de lo contrario, usa Arial o una fuente sans-serif similar */
            font-size: 15px; /* Tamaño de fuente 11 */
        }
        .normal-title {
            background-color: #203764; /* Color deseado para el fondo */
            color: #fff; /* Color deseado para el texto */
            text-align: center;
        }
        .cliente-title {
            background-color: #FFC000; /* Color deseado para el fondo */
            color: #000; /* Color deseado para el texto */
            text-align: center;
        }
        .trabajo-title {
            background-color: #00B050; /* Color deseado para el fondo */
            color: #000; /* Color deseado para el texto */
            text-align: center;
        }
        .documentacion-title {
            background-color: #FFC000; /* Color deseado para el fondo */
            color: #000; /* Color deseado para el texto */
            text-align: center;
        }
        .importe-title {
            background-color: #00B050; /* Color deseado para el fondo */
            color: #000; /* Color deseado para el texto */
            text-align: center;
        }
        .facturacion-title {
            background-color: #FFC000; /* Color deseado para el fondo */
            color: #000; /* Color deseado para el texto */
            text-align: center;
        }
        .abono-title {
            background-color: #00B050; /* Color deseado para el fondo */
            color: #000; /* Color deseado para el texto */
            text-align: center;
        }
        .busqueda-avanzada {
            display: none;
        }

        #btnBusquedaAvanzada {
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            border-bottom: 1px solid transparent;
            transition: border-bottom 0.3s ease;
        }
        #btnBusquedaAvanzada:hover {
            border-bottom: 2px solid #007bff;
        }
        .vertical-center {
            display: flex;
            align-items: center;
        }
        .datepicker-orient-top {
            top: 100px !important;
        }
    </style>
@endsection

@section('page-header')
    <h1 class="page-title">Publicaciones</h1>
@endsection

@section('page-title')
    <h5 class="card-title">Listado de publicaciones</h5>

    <a href="{{ route('post.create') }}" class="btn btn-outline-success btn-sm float-right" > <i class="fa fa-plus font-20"></i> Nueva publicación </a>
@endsection

@section('page-breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('post.index') }}"><i class="fa fa-archive"></i> Publicaciones</a>
        </li>
        <li class="breadcrumb-item"><i class="fa fa-plus-circle"></i> Listado</li>
    </ol>
@endsection

@section('content')
    {{--<input type="hidden" id="permissions" value="{{ json_encode($permissions) }}">--}}
    <!--begin::Form-->
    <form action="#">
        <!--begin::Card-->
        <!--begin::Input group-->
        <div class="row">
            <div class="col-md-12">
                <!-- Barra de búsqueda -->
                <div class="input-group">
                    <input type="text" id="title" class="form-control" placeholder="Título de la publicación..." autocomplete="off">
                    <div class="input-group-append ">
                        <button class="btn btn-primary" type="button" id="btn-search">Buscar</button>
                        <a href="#" id="btnBusquedaAvanzada" class="vertical-center ml-3 mt-2">Búsqueda Avanzada</a>
                    </div>
                </div>

                <!-- Sección de búsqueda avanzada (inicialmente oculta) -->
                <div class="mt-3 busqueda-avanzada">
                    <!-- Aquí coloca más campos de búsqueda avanzada -->
                    <div class="row">

                        <div class="col-md-3">
                            <label for="year">Año de publicación:</label>
                            <select id="year" class="form-control form-control-sm select2" style="width: 100%;">
                                <option value="">TODOS</option>
                                @for ($i=0; $i<count($arrayYears); $i++)
                                    <option value="{{ $arrayYears[$i] }}">{{ $arrayYears[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="user">Creador:</label>
                            <select id="user" name="user" class="form-control form-control-sm select2" style="width: 100%;">
                                <option value="">TODOS</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="category">Categoría:</label>
                            <select id="category" name="category" class="form-control form-control-sm select2" style="width: 100%;">
                                <option value="">TODOS</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->description }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="campoExtra">Fechas de la publicación:</label>
                            <div class="col-md-12" id="sandbox-container">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="form-control form-control-sm date-range-filter" id="start" name="start" autocomplete="off">
                                    <span class="input-group-addon">&nbsp;&nbsp;&nbsp; al &nbsp;&nbsp;&nbsp; </span>
                                    <input type="text" class="form-control form-control-sm date-range-filter" id="end" name="end" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Añade más campos según lo necesario -->
                </div>
            </div>
        </div>
        <!--end::Input group-->

    </form>
    <!--end::Form-->

    <!--begin::Toolbar-->
    <div class="d-flex flex-wrap flex-stack pb-7">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bolder me-5 my-1"><span id="numberItems"></span> Publicaciones encontradas
                <span class="text-gray-400 fs-6">por fecha de creación ↓ </span>
            </h3>
        </div>
        <!--end::Title-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Tab Content-->
    <div class="tab-content">
        <!--begin::Tab pane-->
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered letraTabla table-hover table-sm">
                <thead>
                <tr class="normal-title">
                    <th>ID</th>
                    <th>Fecha publicación</th>
                    <th>Título</th>
                    <th>Idea</th>
                    <th>Creador</th>
                    <th>Categoría</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="body-table">

                </tbody>
            </table>
        </div>
        <!--end::Tab pane-->
        <!--begin::Pagination-->
        <div class="d-flex flex-stack flex-wrap pt-1">
            <div class="fs-6 fw-bold text-gray-700" id="textPagination"></div>
            <!--begin::Pages-->
            <ul class="pagination" style="margin-left: auto;" id="pagination">

            </ul>
            <!--end::Pages-->
        </div>
        <!--end::Pagination-->
    </div>
    <!--end::Tab Content-->

    <template id="previous-page">
        <li class="page-item previous">
            <a href="#" class="page-link" data-item>
                <!--<i class="previous"></i>-->
                <i class="fas fa-chevron-left"></i>
            </a>
        </li>
    </template>

    <template id="item-page">
        <li class="page-item" data-active>
            <a href="#" class="page-link" data-item="">5</a>
        </li>
    </template>

    <template id="next-page">
        <li class="page-item next">
            <a href="#" class="page-link" data-item>
                <!--<i class="next"></i>-->
                <i class="fas fa-chevron-right"></i>
            </a>
        </li>
    </template>

    <template id="disabled-page">
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
    </template>

    <template id="item-table">
        <tr>
            <td data-id></td>
            <td data-date_posted></td>
            <td data-title></td>
            <td data-idea></td>
            <td data-user></td>
            <td data-category></td>
            <td data-buttons></td>
        </tr>
    </template>

    <template id="item-table-empty">
        <tr>
            <td colspan="7" align="center">No se ha encontrado ningún dato</td>
        </tr>
    </template>

    <template id="template-active">
        <a data-ver_post target="_blank" href="{{--'+document.location.origin+ '/dashboard/ver/cotizacion/'+item.id+'--}}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Detalles"><i class="fa fa-eye"></i></a>
        <button data-anular data-delete="{{--'+item.id+'--}}" data-name="{{--'+item.description_quote+'--}}" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular"><i class="fa fa-trash"></i></button>
    </template>

@endsection

@section('plugins')
    <!-- Datatables -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
@endsection

@section('scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('#year').select2({
                placeholder: "Selecione año",
                allowClear: true
            });

            $('#user').select2({
                placeholder: "Selecione",
                allowClear: true
            });
            $('#category').select2({
                placeholder: "Selecione",
                allowClear: true
            });

        })
    </script>
    <script src="{{ asset('js/blog/index.js') }}?v={{ time() }}"></script>

@endsection
