@extends('layouts.master')

@section('title-mini4wd', 'Welcome')

@push('onpagecss')
    <style>
        body, html{
            height: 100%;

        }
        body {
            background-image: url({{ asset('assets/images/maha/bg_maha.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }

        /* For screens smaller than 768px (mobile phones) */
        @media (max-width: 768px) { 
            body {
                background-size: cover;
                background-position: center center;
                background-attachment: fixed;
            }
        }

        /* For screens larger than 768px (tablets and desktops) */
        @media (min-width: 769px) {
            body {
                background-size: cover;
                background-position: center center;
                background-attachment: fixed;
            }
        }
      
        


    </style>
@endpush

@section('page-minicup')
<div class="container col-6 col-sm-4">
    <div class="py-3 my-3">
        <div class="col-4 mx-auto">
            <img src="{{ asset('assets/images/maha/kementerian_maha.png') }}" class="img-fluid d-block mx-auto" >
        </div>
    </div>
    <div class="py-3 my-3">
        <div class="col-15 col-sm-12">
            <img src="{{ asset('assets/images/maha/logo_maha.png') }}" class="img-fluid d-block mx-auto" >
        </div>
    </div>   
    <div class="py-3 my-3">
        <div class="col-15 col-sm-12">
            <img src="{{ asset('assets/images/maha/prizes_maha.png') }}" class="img-fluid d-block mx-auto" >
        </div>
    </div>     
        <div class="container pt-sm-0 pb-sm-5 pt-4 pb-2 ">
            <div class="row">
                <div class="col-md-5 mx-auto position-absolute top-100 start-50 translate-middle" style="width:300px;">
                    <a href="{{ route('register-form') }}">
                        <div class="py-sm-4 px-sm-4 py-3 px-3 rounded mb-3 text-sm-center text-center"  style="background-color:#294626;">
                            <h3 class="text-white text-uppercase font-weight-700 my-0">Teruskan</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

         
    
@endsection

@push('onpagescript')
    <script>
        function setExtraBoxSize() {
            var bxwidth = $('#event-tentative').width();
            var bxheight = $('#event-tentative').height();

            $('.extra-box').css({
                'width': bxwidth,
                'height': bxheight,
            });
        }

        // Call the function on page load
        $(document).ready(function() {
            setExtraBoxSize();
        });

        // Call the function on window resize
        $(window).resize(function() {
            setExtraBoxSize();
        });
    </script>
@endpush
