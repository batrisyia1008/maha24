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
        td, th{
            text-align: center;
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
            // adjustWelcomeBodyHeight();

            // Run the function on window resize
            // $(window).resize(function() {
            //     adjustWelcomeBodyHeight();
            // });
        });
    </script>
@endpush


@section('page-minicup')

    <div id="welcome-body" class="container py-sm-4 my-sm-4 py-2 my-2 d-sm-block d-flex justify-content-center align-items-center">
        <div>
            <div class="row justify-content-center">
                <div class="col-md-3 col-5">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-03.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center maha100th-logo" {{--style="background-image:url({{ asset('assets/images/maha/maha-2024-image-slice-04.png') }}); background-repeat: no-repeat; background-size: 100% auto; "--}}>
                <div class="col-md-12 col-12 py-sm-0 my-sm-0 py-0 my-0">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-02.png') }}" alt="" class="img-fluid mx-auto d-block maha100th-logo-img">
                    <h1 class="text-black text-center fw-800">Belanja sekarang di MAHA2024 dan berpeluang memenangi hadiah istimewa!</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9 col-12 py-sm-0 my-sm-0 py-0 my-0">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-01.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9 col-12 py-sm-0 my-sm-0 py-1 my-1">
                    <h4 class="text-center pb-4 fw-700">Sertai kami di tapak <br> <i>RHYTHM OF THE FARMERS (ROTF)</i> <br> bertempat di
                        <a class="text-blue" target="_blank" href="https://www.google.com/maps/dir//D+Lereng+MAEPS,+XMHW%2BH5,+43400+Seri+Kembangan,+Selangor/@2.9789331,101.6542391,13z/data=!4m8!4m7!1m0!1m5!1m1!1s0x31cdb5002a91ac0b:0xb3f7cb52892c534d!2m2!1d101.6954385!2d2.9789339?entry=ttu&g_ep=EgoyMDI0MDkxMC4wIKXMDSoASAFQAw%3D%3D">D Lereng MAEPS Serdang</a></h4>
                    {{--<p class="text-center pb-3"><a href="#submit" class="btn btn-link text-black">Terus kebawah</a></p>--}}

                    <div class="text-center text-black fw-700">
                        <a class="btn btn-maha-green btn-lg border-2 border-white px-4 py-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Jadual waktu cabutan bertuah
                        </a>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <table class="table bg-white table-bordered">
                            <thead>
                            <tr>
                                <th rowspan="2">Tarikh</th>
                                <th colspan="2">Masa</th>
                            </tr>
                            <tr>
                                <th>Sesi 1</th>
                                <th>Sesi 2</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Rabu<br>11/09/2024</td>
                                <td></td>
                                <td>09:30 PM</td>
                            </tr>
                            <tr>
                                <td>Khamis<br>12/09/2024</td>
                                <td>03:30 PM</td>
                                <td>09:30 PM</td>
                            </tr>
                            <tr>
                                <td>Jumaat<br>13/09/2024</td>
                                <td>03:30 PM</td>
                                <td>09:30 PM</td>
                            </tr>
                            <tr>
                                <td>Sabtu<br>14/09/2024</td>
                                <td>03:30 PM</td>
                                <td>09:30 PM</td>
                            </tr>
                            <tr>
                                <td>Ahad<br>15/09/2024</td>
                                <td>03:30 PM</td>
                                <td>09:30 PM</td>
                            </tr>
                            <tr>
                                <td>Isnin<br>16/09/2024</td>
                                <td>03:30 PM</td>
                                <td>09:30 PM</td>
                            </tr>
                            <tr>
                                <td>Selasa<br>17/09/2024</td>
                                <td>03:30 PM</td>
                                <td>09:30 PM</td>
                            </tr>

                            <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="submit" class="row justify-content-center">
                <div class="col-md-12 py-sm-3 my-sm-3 py-3 my-3 text-center">
                    <a href="{{ route('maha.register-form') }}" class="btn button-xxl px-5 btn-maha-green">Teruskan</a>
                </div>
            </div>
        </div>
    </div>

@endsection

