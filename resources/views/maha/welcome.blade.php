@extends('layouts.master')

@section('title-mini4wd', 'Welcome')

@push('onpagecss')
    <style>
        body {
            background-image: url({{ asset('assets/images/maha/maha-2024-image-slice-06.png') }});
            background-size: cover;
            background-position: bottom center;
            background-repeat: no-repeat;
        }
        .button-xxl {
            padding: 1em;
            font-size: 1.25rem;
            border-width: 3px;
            border-color: #FFFFFF;
        }
        @media only screen and (max-width: 600px) {
            body {
                min-height: 100vh;
                overflow-x: hidden;
            }
            .button-xxl {
                padding: inherit;
                font-size: inherit;
            }
        }
    </style>
@endpush

@push('onpagescript')
<script>
    $(document).ready(function() {
        // Function to adjust the height of welcome-body
        function adjustWelcomeBodyHeight() {
            var windowWidth = $(window).width();
            if (windowWidth <= 600) {
                // Get the height of the .header-bg-image element
                var borderHeight = $('.header-bg-image').height();

                // Convert 6rem to pixels for calculations
                var remToPx = parseFloat(getComputedStyle(document.documentElement).fontSize);
                var additionalHeight = 5 * remToPx;

                // Set the height of #welcome-body, subtracting the border height and adding 6rem
                $('#welcome-body').css('height', 'calc(100vh - ' + (borderHeight + additionalHeight) + 'px)');
            } else {
                // Reset the height if the screen width is above 600px
                $('#welcome-body').css('height', '');
            }
        }

        // Run the function on page load
        adjustWelcomeBodyHeight();

        // Run the function on window resize
        $(window).resize(function() {
            adjustWelcomeBodyHeight();
        });
    });
</script>
@endpush


@section('page-minicup')

    <div id="welcome-body" class="container py-sm-4 my-sm-4 py-4 my-4 d-sm-block d-flex justify-content-center align-items-center">
        <div>
            <div class="row justify-content-center">
                <div class="col-md-3 col-5">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-03.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center maha100th-logo" {{--style="background-image:url({{ asset('assets/images/maha/maha-2024-image-slice-04.png') }}); background-repeat: no-repeat; background-size: 100% auto; "--}}>
                <div class="col-md-12 col-12 py-sm-3 my-sm-3 py-3 my-3">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-02.png') }}" alt="" class="img-fluid mx-auto d-block maha100th-logo-img">
                    <h1 class="text-black text-center fw-800">Belanja sekarang di MAHA2024 dan berpeluang memenangi hadiah istimewa!</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9 col-12 py-sm-3 my-sm-3 py-2 my-2">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-01.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 py-sm-3 my-sm-3 py-3 my-3 text-center">
                    <a href="{{ route('maha.register-form') }}" class="btn button-xxl px-5 btn-maha-green">Teruskan</a>
                </div>
            </div>
        </div>
    </div>

@endsection

