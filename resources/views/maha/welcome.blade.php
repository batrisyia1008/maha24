@extends('layouts.master')

@section('title-mini4wd', 'Welcome')

@section('page-minicup')
    <div class="bg-mhx-blue">
        <div>
            <div class="container p-sm-5 p-3">
                <div class="row g-0 align-items-center position-relative">
                    <div class="col-md-5 col-12 z-9">
                        <img src="{{ asset('assets/images/mini-4wd/mini-4wd-mhxcup-round@4x.png') }}" alt="" class="img-fluid d-block mx-auto">
                    </div>
                    <div id="event-tentative" class="col-md-7 col-12 z-9">
                        <div class="p-sm-3 px-1 pt-3 pb-3">
                            <div class="py-sm-3 px-sm-4 py-3 px-3 rounded-pill mb-3 bg-mhx-red text-sm-start text-center">
                                <h3 class="text-white text-uppercase font-weight-700 my-0">Main Event Tentative</h3>
                            </div>
                            <div class="">
                                <ul class="text-uppercase">
                                    <li>
                                        <h3 class="font-weight-700 mb-0 text-mhx-blue">Race Venue</h3>
                                        <h3 class="font-weight-700 mb-3">MAEPS Serdang Hall B</h3>
                                    </li>
                                    <li>
                                        <h3 class="font-weight-700 mb-0 text-mhx-blue">Race Date</h3>
                                        <h3 class="font-weight-700 mb-3">2nd & 3rd December 2023</h3>
                                    </li>
                                    <li>
                                        <h3 class="font-weight-700 mb-0 text-mhx-blue">Race Time</h3>
                                        <h3 class="font-weight-700 mb-3">10:00 AM to 10:00 PM</h3>
                                    </li>
                                </ul>
                                {{--<h4 class="text-sm-start text-center mb-0 text-uppercase font-weight-700 text-mhx-red px-3">Track Layout, Race Rules, Fees Will Be Release Soon!</h4>--}}
                            </div>
                        </div>
                    </div>
                    <div class="extra-box"></div>
                </div>
            </div>
        </div>

        <div class="container pt-sm-0 pb-sm-5 pt-4 pb-2">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <a href="{{ route('register-form') }}">
                        <div class="py-sm-4 px-sm-4 py-3 px-3 rounded-pill mb-3 bg-mhx-red text-sm-center text-center shine shadow-lg">
                            <h3 class="text-white text-uppercase font-weight-700 my-0">Join The Race !!!</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="container px-sm-5 py-sm-3 py-3">
                <div class="row">
                    <div class="col-md-12 col-12 p-sm-5 py-4 bg-mhx-orange rounded-5 shadow-lg">
                        <img src="{{ asset('assets/images/mini-4wd/prize-pool@4x.png') }}" alt="" class="img-fluid d-block mx-auto mb-4">

                        <div class="card-group">
                            <div class="card border-0 bg-mhx-orange">
                                <div class="card-body text-center">
                                    <h3 class="bg-mhx-red text-white card-title py-10px rounded-pill font-weight-700 mb-4">SEMI-TECH</h3>
                                    <h5 class="mb-4"> <strong>CHAMPION</strong> <br> <strong class="text-mhx-blue font-weight-700">RM10,000 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"> <strong>1ST RUNNER UP</strong> <br> <strong class="text-mhx-blue font-weight-700">RM4,000 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"> <strong>2ND RUNNER UP</strong> <br> <strong class="text-mhx-blue font-weight-700">RM2,000 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"> <strong>NO. 4 - 6</strong> <br> <strong class="text-mhx-blue font-weight-700">RM1,000 + MHXM4WD MEDAL</strong></h5>
                                    <h5 class=""> <strong>NO. 7 - 9</strong> <br> <strong class="text-mhx-blue font-weight-700">RM500 + MHXM4WD MEDAL</strong></h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-mhx-orange">
                                <div class="card-body text-center">
                                    <h3 class="bg-mhx-red text-white card-title py-10px rounded-pill font-weight-700 mb-4">B-MAX</h3>
                                    <h5 class="mb-4"><strong>CHAMPION</strong> <br> <strong class="text-mhx-blue font-weight-700">RM3,000 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"><strong>1ST RUNNER UP</strong> <br> <strong class="text-mhx-blue font-weight-700">RM1,500 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"><strong>2ND RUNNER UP</strong> <br> <strong class="text-mhx-blue font-weight-700">RM800 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"><strong>NO. 4 - 6</strong> <br> <strong class="text-mhx-blue font-weight-700">RM400 + MHXM4WD MEDAL</strong></h5>
                                    <h5 class=""><strong>NO. 7 - 9</strong> <br> <strong class="text-mhx-blue font-weight-700">RM200 + MHXM4WD MEDAL</strong></h5>
                                </div>
                            </div>
                            <div class="card border-0 bg-mhx-orange">
                                <div class="card-body text-center">
                                    <h3 class="bg-mhx-red text-white card-title py-10px rounded-pill font-weight-700 mb-4">STOCK-CAR</h3>
                                    <h5 class="mb-4"><strong>CHAMPION</strong> <br> <strong class="text-mhx-blue font-weight-700">RM1,000 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"><strong>1ST RUNNER UP</strong> <br> <strong class="text-mhx-blue font-weight-700">RM500 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"><strong>2ND RUNNER UP</strong> <br> <strong class="text-mhx-blue font-weight-700">RM250 + MHXM4WD CUP</strong></h5>
                                    <h5 class="mb-4"><strong>NO. 4 - 6</strong> <br> <strong class="text-mhx-blue font-weight-700">RM150 + MHXM4WD MEDAL</strong></h5>
                                    <h5 class=""><strong>NO. 7 - 9</strong> <br> <strong class="text-mhx-blue font-weight-700">RM100 + MHXM4WD</strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container pt-sm-5 pb-sm-2 pt-4 px-5">
                <div class="row g-5">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/rule_battery_allowed.jpeg') }}" alt="" class="img-fluid mx-auto img-thumbnail">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/rule_motor_allowed.jpeg') }}" alt="" class="img-fluid mx-auto img-thumbnail">
                    </div>
                </div>
            </div>
            <div class="container p-sm-5">
                <img src="{{ asset('assets/images/mini-4wd/race-with-passion!@4x.png') }}" alt="" class="img-fluid pt-sm-0 pb-sm-0 pt-4 pb-4">
            </div>
        </div>

        <div>
            <div class="container px-sm-5 pt-sm-3 pb-sm-5 py-3">
                <div class="row">
                    <div class="col-md-12 col-12 p-sm-5 py-4 bg-mhx-orange rounded-5 shadow-lg">
                        <h1 class="text-center font-weight-700 mb-4">EVENT TENTATIVE</h1>
                        <div class="card-group">
                            <div class="card border-0 bg-mhx-orange">
                                <div class="card-body text-center">
                                    <h3 class="bg-mhx-red text-white card-title py-10px rounded-pill font-weight-700 mb-4">SEMI-TECH</h3>
                                    <h4 class="font-weight-700 text-uppercase mb-0 text-mhx-red">race day</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0 text-mhx-red">Sunday</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3 text-mhx-red">3rd December 2023</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">free practice</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3">8.30am - 10.00am</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">rumble session</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3">10.00am - 2.00pm</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">round 1 to final</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">2.30pm - 10.00pm</h4>
                                </div>
                            </div>
                            <div class="card border-0 bg-mhx-orange">
                                <div class="card-body text-center">
                                    <h3 class="bg-mhx-red text-white card-title py-10px rounded-pill font-weight-700 mb-4">B-MAX</h3>
                                    <h4 class="font-weight-700 text-uppercase mb-0 text-mhx-red">race day</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0 text-mhx-red">Saturday</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3 text-mhx-red">2nd December 2023</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">free practice</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3">8.30am - 10.00am</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">rumble session</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3">10.00am - 2.00pm</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">round 1 to final</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3">2.30pm - 10.00pm</h4>
                                </div>
                            </div>
                            <div class="card border-0 bg-mhx-orange">
                                <div class="card-body text-center">
                                    <h3 class="bg-mhx-red text-white card-title py-10px rounded-pill font-weight-700 mb-4">STOCK-CAR</h3>
                                    <h4 class="font-weight-700 text-uppercase mb-0 text-mhx-red">race day</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0 text-mhx-red">Sunday</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3 text-mhx-red">3rd December 2023</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">free practice</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3">8.30am - 10.00am</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-0">round 1 to final</h4>
                                    <h4 class="font-weight-700 text-uppercase mb-3">10.00am - 10.00pm</h4>
                                    <h5 class="font-weight-700 text-uppercase text-mhx-red"><i>only open to racer 15 years old and below</i></h5>
                                </div>
                            </div>
                        </div>

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
