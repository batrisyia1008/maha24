@extends('layouts.master')

@section('title-mini4wd', 'QR Code')

@push('onpagecss')
    <style>
        body {
            background-image: url({{ asset('assets/images/maha/maha-2024-image-slice-06.png') }});
            background-size: cover;
            background-position: bottom center;
            background-repeat: no-repeat;
        }
        @media only screen and (max-width: 600px) {
            body {
                min-height: 100vh;
                overflow-x: hidden;
            }
        }
    </style>
@endpush

@push('onpagescript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to adjust the height of welcome-body
        function adjustWelcomeBodyHeight() {
            var windowWidth = $(window).width();
            if (windowWidth <= 600) {
                // Get the height of the .header-bg-image element
                var borderHeight = $('.header-bg-image').height();

                // Convert 5rem to pixels for calculations
                var remToPx = parseFloat(getComputedStyle(document.documentElement).fontSize);
                var additionalHeight = 5 * remToPx;

                // Set the height of #welcome-body, subtracting the border height and adding 5rem
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

        // Function to save the entire body as an image
        $('#download').click(function(e) {
            e.preventDefault(); // Prevent the default link action

            // Temporarily hide overflow
            var originalOverflow = $('body').css('overflow');
            $('body').css('overflow', 'hidden');

            html2canvas(document.body, {
                scrollX: 0,
                scrollY: -window.scrollY, // Capture the currently visible part of the page
                useCORS: true // Allow images from other domains
            }).then(function(canvas) {
                // Create a link element
                var link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'screenshot.png'; // Set the file name for download

                // Append link to the body, click it to trigger download, then remove it
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                // Restore the original overflow property
                $('body').css('overflow', originalOverflow);
            });
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
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5 col-8">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset($data->qr_code) }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10 py-4 my-4 text-center">
                    <h5 class="text-white fw-700 mb-5">Please make sure to screenshot and save to your mobile phone gallery.</h5>
                    <a href="" id="download" class="btn button-xxl px-5 btn-maha-green">Muat Turun</a>
                </div>
            </div>
        </div>
    </div>

@endsection

