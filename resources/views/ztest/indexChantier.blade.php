@extends('layouts.layouts')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Accueil</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active">Accueil</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                <div class="">
                </div>
            </div>
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                <div class="chart-text m-r-10">
                </div>
                <div class="">
                    </div>
                </div>
            </div>
            <div class="">
                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
            </div>
        </div>
    </div>
</div>



<div class="col-12 m-t-30">
    <div class="card">
        <div class="card-body collapse show">
            <h4 class="card-title">Special title treatment</h4>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div>
</div>

<div class="col-lg-4 col-xlg-3 col-md-5">
    <div class="card blog-widget">
        <div class="card-body">
            <h3>Generalite & historique</h3>
            <p class="m-t-20 m-b-20">
                Lorem ipsum dolor sit amet, this is a consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            </p>
            <div class="d-flex">
                <div class="read">
                    <a href="javascript:void(0)" class="link font-medium">Read More</a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
