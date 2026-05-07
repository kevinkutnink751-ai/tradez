@php
    if ($settings->redirect_url != null or !empty($settings->redirect_url)) {
        header("Location: $settings->redirect_url", true, 301);
        exit();
    }
@endphp
@extends('layouts.base')
@section('title', 'Terms and Privacy And Policy')
@section('styles')
    @parent
@endsection
@inject('content', 'App\Http\Controllers\FrontController')
@section('content')
   
     <!-- Hero Section -->
    <section class="section py-5 mt-5 bg-dark-custom position-relative" style="min-height: 400px; display: flex; align-items: center; overflow: hidden;">
        <div class="position-absolute dot-grid-bg" style="top:0; right:0; width:50%; height:100%; z-index:1; opacity:0.15;"></div>
     
        
        <div class="container position-relative" style="z-index:3;">
            <div class="row w-100">
                <div class="col-lg-8" data-aos="fade-right">
                    <h1 class="display-4 font-weight-bold mb-4 text-white">Privacy and Policy</h1>
                    <p class="text-muted lead mb-5 max-width-700">{{ $settings->privacy_description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Privacy -->
    <section class="section bg-light-custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="border-0 rounded shadow card">
                        <div class="card-body bg-dark-custom rounded-lg text-muted">
                            {!! $terms->description !!}
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End Privacy -->



@endsection

@section('scripts')
    @parent

@endsection
