@extends('layouts.appAdmin')

@section('title')
    Dashboard
@endsection

@section('openAdmin', 'menu-open')

@section('activeAdmin', 'active')

@section('styles-plugins')

@endsection

@section('page-header')
    <h1 class="page-title">Dashboard</h1>
@endsection

@section('page-breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
        </li>
    </ol>
@endsection

@section('page-title')
    <h5 class="card-title">PANEL PRINCIPAL</h5>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
