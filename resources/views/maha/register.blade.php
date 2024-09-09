@extends('layouts.master')

@section('title-mini4wd', 'Maklumat Peserta')

@push('onpagecss')
    <style>
        body {
            background-image: url({{ asset('assets/images/maha/maha-2024-image-slice-06.png') }});
            background-size: cover;
            background-position: bottom center;
            background-repeat: no-repeat;
        }
    </style>
@endpush

@push('onpagescript')
    <script>
    </script>
@endpush

@section('page-minicup')

    <div class="container py-sm-4 my-sm-4 py-4 my-4 d-sm-block">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="{{ asset('assets/images/maha/logo_maha_100yrs.png') }}" class="logo img-fluid">
            </div>
        </div>

        <div class="row">
            <div id="confirm" class="col-md-6 mx-auto">
                <form action="{{ route('maha.register') }}" method="POST" id="racer_register" accept-charset="utf-8" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-4" id="section_a">
                        <div class="card-body">

                            <h5 class="font-weight-700">Bahagian A - Maklumat Peserta</h5>
                            <hr class="my-10px">

                            <input type="hidden" name="zone" value="{{ $zone->id }}" class="form-control mb-3" readonly>

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
                                <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="" name="email" value="{{ old('email') }}">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Berasal <span class="text-danger">*</span></label>
                                <select name="states" id="" class="form-control select2">
                                    <option value="">{{ __('Pilih') }}</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <div class="block">
                                    <label for="email" class="form-label">Jantina <span class="text-danger">*</span></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="lelaki" value="lelaki">
                                            <label class="form-check-label" for="lelaki">Lelaki</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="wanita" value="wanita">
                                            <label class="form-check-label" for="wanita">Wanita</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <label for="nickname" class="form-label">Bagaimanakah anda mengetahui tentang acara ini?<span class="text-danger">*</span></label>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="social_media" value="social_media" name="know_platform[]">
                                    <label class="form-check-label" for="social_media">Media Sosial (Facebook, X, Instagram, etc.)</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="emails" value="emails" name="know_platform[]">
                                    <label class="form-check-label" for="emails">Email dan Surat Khabar</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="events_calendar" value="events_calendar" name="know_platform[]">
                                    <label class="form-check-label" for="events_calendar">Kalendar Acara (Dalam Talian atau Fizikal)</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="advertisements" value="advertisements" name="know_platform[]">
                                    <label class="form-check-label" for="advertisements">Iklan (Dalam Talian atau Luar Talian)</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="celebrity" value="celebrity" name="know_platform[]">
                                    <label class="form-check-label" for="celebrity">Sokongan Selebriti atau Pempengaruh</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="books" value="books" name="know_platform[]">
                                    <label class="form-check-label" for="books">Buku atau Artikel</label>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" id="friend" value="friend" name="know_platform[]">
                                    <label class="form-check-label" for="friend">Rakan, Keluarga atau Rakan Sekerja</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" id="section_b">
                        <div class="card-body">
                            <h5 class="font-weight-700">Bahagian B - Muat Naik Resit</h5>
                            <hr class="my-10px">

                            <div class="mb-0">
                                {{--<label for="registrationSlot" class="form-label">Muat Naik Resit Anda Disni</label>--}}
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="resits[]">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="resits[]">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="resits[]">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="resits[]">
                                </div>

                                <div class="input-group mb-0">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="resits[]">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-4" id="payment">
                        <div class="card-body">
                            <h5 class="font-weight-700">Bahagian C - Jumlah Pembelian</h5>
                            <hr class="my-10px">

                            <div class="mb-3">
                                <label for="total_cost" class="form-label mb-1">Jumlah Pembelian <span class="text-danger">*</span></label>
                                <input type="text" inputmode="numeric" name="total" value="" class="form-control mb-3">
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="mb-0 text-center">
                                        <button type="submit" class="btn btn-maha-green btn-lg w-100 text-white">
                                            Hantar
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

@endsection
