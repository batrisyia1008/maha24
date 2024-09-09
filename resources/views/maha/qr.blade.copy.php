@extends('layouts.master')

@section('title-mini4wd', 'QR Code')

@push('onpagecss')
    <style>
        body, html{
            min-height: auto;

        }
        body {
            background-image: url({{ asset('assets/images/maha/bg_maha.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: scroll;
        }
        .qr-placement {
            width: 50px;
            height: 50px;
            padding: 100px 0;
            margin-bottom: 100px;



        }

        /* For screens smaller than 768px (mobile phones) */
        @media (max-width: 768px) {
            body {
                background-size: cover;
                background-position: center center;
                background-attachment: scroll;
            }
            .container {
                margin-top: 50px;
                padding-top: 20px;
                margin-bottom: 50px;
                padding-bottom: 100px;
            }
            h4{
                margin-top: 20px;
                padding-top: 40px;
                padding-bottom: 50px;

            }

        }

        /* For screens larger than 768px (tablets and desktops) */
        @media (min-width: 769px) {
            body {
                background-size: cover;
                background-position: center center;
                background-attachment: scroll;
            }
        }
    </style>
@endpush

@push('onpagescript')

@endpush

@section('page-minicup')
    <div class="container col-lg-4 col-md-8 col-sm-4">
        <div class="mt-lg-3 pt-sm-3 mt-sm-5 pt-sm-5">
            <div class="col-4 mx-auto">
                <img src="{{ asset('assets/images/maha/kementerian_maha.png') }}" class="img-fluid d-block mx-auto" >
            </div>
            <div class="py-1 my-1">
                <div class="col-lg-12 max-width">
                    <img src="{{ asset('assets/images/maha/logo_maha.png') }}" class="logo img-fluid d-block mx-auto" >
                </div>
            </div>
            <div class="card bg-label-secondary">
                <div class="card-body p-1 ">
                    <div class="qr-placement">
                        <img src="{{ asset($data->qr_code) }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="mt-1 mb-1 ">
                <div class="col-lg-12 max-width text-center text-white">
                    <h4><strong>Please make sure to screenshot and save to your mobile phone gallery.</strong></h4>
                </div>
            </div>
        </div>
    </div>

@endsection
