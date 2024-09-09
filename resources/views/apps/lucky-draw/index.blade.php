@extends('layouts.master')

@section('title-mini4wd', 'Lucky Draw')

@push('onpagecss')
    <style>
        body {
            background-image: url({{ asset('assets/images/maha/maha-2024-image-slice-06.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: scroll;
            min-height: 100vh;
        }
    </style>
@endpush

@push('onpagescript')

@endpush

@section('page-minicup')
    <div class="container py-sm-4 my-sm-4 py-4 my-4 d-sm-block d-flex justify-content-center align-items-center">
        <div>
            <div class="row justify-content-center">
                <div class="col-md-3 col-5">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-03.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center maha100th-logo" {{--style="background-image:url({{ asset('assets/images/maha/maha-2024-image-slice-04.png') }}); background-repeat: no-repeat; background-size: 100% auto; "--}}>
                <div class="col-md-12 col-12 py-sm-3 my-sm-3 py-3 my-3">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-02.png') }}" alt="" class="img-fluid mx-auto d-block maha100th-logo-img">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
@endsection
