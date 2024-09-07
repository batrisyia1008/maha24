@extends('layouts.master')

@section('title-mini4wd', 'Maklumat Peserta')

@push('onpagecss')
    <style>
        body {
            background-image: url({{ asset('assets/images/maha/bg_maha.png') }});
            background-repeat: no-repeat;
            background-size: cover;
        }
        .btn-green {
            --bs-btn-color: #294626;
            --bs-btn-bg: #294626;
            --bs-btn-border-color: #294626;
            --bs-btn-hover-color: #294626;
            --bs-btn-hover-bg: #294626;
            --bs-btn-hover-border-color: #294626;
            --bs-btn-focus-shadow-rgb: 41,70,38,255;
            --bs-btn-active-color: #294626;
            --bs-btn-active-bg: #294626;
            --bs-btn-active-border-color: #294626;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(41,70,38,255);
            --bs-btn-disabled-color: #294626;
            --bs-btn-disabled-bg: #294626;
            --bs-btn-disabled-border-color: #294626;
        }
    </style>
@endpush

@push('onpagescript')
    <script>
    </script>
@endpush

@section('page-minicup')
    <div class="container px-sm-5 p-3">
        <div class="py-5 mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <img src="{{ asset('assets/images/maha/logo_maha_100yrs.png') }}" class="logo img-fluid">
                </div>
            </div>

            <div class="row">
                <div id="confirm" class="col-md-6 mx-auto">
                    <form action="{{ route('qrcode') }}" method="GET" id="racer_register" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-4" id="section_a">
                            <div class="card-body">

                                <h5 class="font-weight-700">Bahagian A - Maklumat Peserta</h5>
                                <hr class="my-10px">

                                <input type="hidden" name="category" value="{{--{{ $category['category'] }}--}}" class="form-control mb-3" readonly>
                                <input type="hidden" name="price_category" value="{{--{{ $category['price_category'] }}--}} " class="form-control mb-3" readonly>

                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Nama Penuh <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="full_name" value="{{ old('full_name') }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="identification_card_number" class="form-label">Nombor Kad Pengenalan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="identification_card_number" value="{{ old('identification_card_number') }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Nombor Telefon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="" name="phone_number" value="{{ old('phone_number') }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Alamat Email </label>
                                    <input type="email" class="form-control" id="" name="email" value="{{ old('email') }}">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="nickname" class="form-label">Bagaimanakah anda mengetahui tentang acara ini?<span class="text-danger">*</span></label>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="social_media" value="social_media" name="know_platform[]">
                                        <label class="form-check-label" for="social_media">Media Sosial (Facebook, X, Instagram, etc.)</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="emails" value="emails" name="know_platform[]">
                                        <label class="form-check-label" for="emails">Email dan Surat Khabar</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="events_calendar" value="events_calendar" name="know_platform[]">
                                        <label class="form-check-label" for="events_calendar">Kalendar Acara (Dalam Talian atau Fizikal)</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="advertisements" value="advertisements" name="know_platform[]">
                                        <label class="form-check-label" for="advertisements">Iklan (Dalam Talian atau Luar Talian)</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="celebrity" value="celebrity" name="know_platform[]">
                                        <label class="form-check-label" for="celebrity">Sokongan Selebriti atau Pempengaruh</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="books" value="books" name="know_platform[]">
                                        <label class="form-check-label" for="books">Buku atau Artikel</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="friend" value="friend" name="know_platform[]">
                                        <label class="form-check-label" for="friend">Rakan, Keluarga atau Rakan Sekerja</label>
                                    </div>



                                </div>

                                {{--<div class="mb-0">--}}
                                {{--<label for="team_group" class="form-label">Team / Group</label>--}}
                                {{--<input type="text" class="form-control" id="" name="team_group" value="{{ old('team_group') }}">--}}
                                {{--<div id="" class="form-text">--}}
                                {{--If not applicable, please write NA.--}}
                                {{--</div>--}}
                                {{--</div>--}}

                            </div>
                        </div>

                        <div class="card mb-4" id="section_b">
                            <div class="card-body">
                                <h5 class="font-weight-700">Bahagian B - Muat Naik Resit</h5>
                                <hr class="my-10px">

                                <div class="mb-3">
                                    <label for="registrationSlot" class="form-label">Muat Naik Resit Anda Disni</label>

                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="inputGroupFile02">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="inputGroupFile02">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="inputGroupFile02">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="inputGroupFile02">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="inputGroupFile02">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card" id="payment">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="total_cost" class="form-label mb-1">
                                        {{--Please remit the below total in RM, using bank transfer to <br>
                                        MAYBANK, INFINITY PULSE SDN BHD, <a id="copyLink" href="">564810562363</a>  <input type="hidden" value="564810562363" id="textToCopy">--}}
                                        Jumlah Pembelian
                                    </label>
                                    <input type="text" inputmode="numeric" name="total" value="" class="form-control mb-3">
                                    {{--<img src="{{ asset('assets/images/mini-4wd/mhx2024_mini_4wd_qrcode.png') }}" alt="" class="img-fluid">--}}
                                </div>

                                {{-- <div class="mb-3">--}}
                                {{--     <label for="receipt" class="form-label">Please upload the receipt of payment <span class="text-danger">*</span></label>--}}
                                {{--     <input type="file" name="receipt" id="" class="form-control">--}}
                                {{--     <div id="" class="form-text">--}}
                                {{--         This method is temporary, it will update with the direct payment--}}
                                {{--     </div>--}}
                                {{--     <div class="invalid-feedback"></div>--}}
                                {{-- </div>--}}

                                <div class="mb-3">
                                    <!-- <p class="mb-0 text-center">By clicking <strong>"Proceed to Pay"</strong>, I hereby agree and consent to the <a target="_blank" href="{{ asset('assets/upload/mhx2024_events-tnc.pdf') }}">Terms & Conditions</a> of the event.</p> -->
                                </div>

                                <div class="row justify-content-center">
                                    {{--<div class="col-md-6">--}}
                                    {{--<div class="mb-0 text-center">--}}
                                    {{--<input type="hidden" name="cashpayment" value="true">--}}
                                    {{--<button type="button" class="btn btn-blue btn-lg w-100 text-white" onclick="submitForm('racer_register')">
                                        By Cash
                                    </button>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="mb-0 text-center">
                                            <button type="submit" class="btn btn-green btn-lg w-100 text-white">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
