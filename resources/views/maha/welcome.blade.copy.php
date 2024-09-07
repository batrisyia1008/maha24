@extends('layouts.master')

@section('title-mini4wd', 'Welcome')

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

        /* For screens smaller than 768px (mobile phones) */
        @media (max-width: 768px) {
            body {
                background-size: cover;
                background-position: center center;
                background-attachment: scroll;

            }
            .container {
                margin-top: 50px; /* Adjust as needed */
                padding-top: 20px; /* Adjust as needed */
                margin-bottom: 50px; /* Adjust as needed */
                padding-bottom: 80px; /* Adjust as needed */
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

@section('page-minicup')
<div class="container col-lg-6 col-md-8 col-sm-4">
    <div class="mt-lg-3 pt-sm-3 mt-sm-5 pt-sm-5">
        <div class="col-4 mx-auto">
            <img src="{{ asset('assets/images/maha/kementerian_maha.png') }}" class="img-fluid d-block mx-auto" >
        </div>
        <div class="py-1 my-1">
            <div class="col-lg-12 max-width">
                <img src="{{ asset('assets/images/maha/logo_maha.png') }}" class="logo img-fluid d-block mx-auto" >
            </div>
        </div>
        <div class="mt-1 mb-1 ">
            <div class="col-lg-12 max-width text-center">
            <h4><strong>Belanja sekarang di Maha2024 dan berpeluang memenangi hadiah istimewa!</strong></h4>
            </div>
        </div>
        <div class="py-2 my-2">
            <div class="col-15 col-sm-12">
                <img src="{{ asset('assets/images/maha/prizes_maha.png') }}" class="img-fluid d-block mx-auto" >
            </div>
        </div>
        <div class="col-md-5 mx-auto" style="width:200px; height:150px;">
            <a href="{{ route('maha.register-form') }}">
                <div class="py-sm-4 px-sm-4 py-3 px-3 mt-sm-4 rounded mb-3 text-sm-center text-center"  style="background-color:#294626;">
                    <h5 class="text-white text-uppercase font-weight-700 my-0">Teruskan</h5>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

@push('onpagescript')
    <script>
        // function setExtraBoxSize() {
        //     var bxwidth = $('#event-tentative').width();
        //     var bxheight = $('#event-tentative').height();

        //     $('.extra-box').css({
        //         'width': bxwidth,
        //         'height': bxheight,
        //     });
        // }

        // Call the function on page load
        // $(document).ready(function() {
        //     setExtraBoxSize();
        // });

        // // Call the function on window resize
        // $(window).resize(function() {
        //     setExtraBoxSize();
        // });
    </script>
@endpush
