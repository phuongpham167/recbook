@extends('layouts.app')

@section('meta-description')
    <meta name="description" content="Home page" >
@endsection

@section('title')
    Recbook.vn
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"/>
@endsection

@section('content')
    @include('includes.header')
    <div class="content-body">
        <div class="slider">
            <div class="smart-search">

            </div>
        </div>
        <section class="featured-real-estate">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        Bat dong san noi bat
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('includes.footer')
@endsection

@section('js')
    <script>

    </script>
@endsection
