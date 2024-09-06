@extends('layouts.master')

@section('title-mini4wd', 'QR Code')

@push('onpagecss')
    <style>
        body {
            background-image: url({{ asset('assets/images/maha/bgqrcode.jpg') }});
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }
    </style>
@endpush

@section('page-minicup')
    <div class="card bg-label-secondary">
        <div class="card-body p-1">
            <div class="qr-placement">
                <img src="" alt="" class="img-fluid">
            </div>
            <img src="" alt="" class="img-fluid">
        </div>
    </div>
        
    <div class="container pt-sm-0 pb-sm-5 pt-4 pb-2 ">
        <div class="row">
            <div class="col-md-5 mx-auto position-absolute top-50 start-50 translate-middle">
                <img src="{{ asset('assets/images/maha/testqrcode.png') }}" alt="" class="img-fluid d-block mx-auto">
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
