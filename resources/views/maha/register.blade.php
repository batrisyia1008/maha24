@extends('layouts.master')

@section('title-mini4wd', 'Maklumat Peserta')

@push('onpagecss')
    <style>
        body {
            background-image: url({{ asset('assets/images/matec-bg-images-05.png') }});
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
        .logo{
            width: -20%;
        }

    </style>
@endpush

@push('onpagescript')
    <script>
        $(document).ready(function () {

            // Function to update registration options
            function updateRegistrationOptions() {
                var category = $("input[name='category']").val();
                var registrationSelect = $("#registrationSlot");
                var currentDate = new Date();

                console.log(currentDate);

                console.log(category);

                // Clear existing options
                registrationSelect.empty();

                registrationSelect.append('<option value="0">0</option>');

                if (category === 'semi-tech class a' || category === 'b-max class b') {
                    // Early bird registration
                    if (currentDate <= new Date('2024-09-15 23:59:59')) {
                        for (var i = 1; i <= 20; i++) {
                            registrationSelect.append('<option value="' + i + '">' + i + '</option>');
                        }
                        console.log('Early bird registration only for 20');
                    }
                    // Pre-event online registration
                    if (currentDate >= new Date('2024-08-01 00:00:00') && currentDate < new Date('2024-09-21 23:59:59')) {
                        for (var i = 1; i <= 20; i++) {
                            registrationSelect.append('<option value="' + i + '">' + i + '</option>');
                        }
                        console.log('Pre-event online registration only for 15');
                    }
                    // Walk-in registration
                    // if (currentDate >= new Date('2024-12-02 00:00:00') && currentDate < new Date('2024-12-03 23:59:59')) {
                    //     for (var i = 1; i <= 15; i++) {
                    //         registrationSelect.append('<option value="' + i + '">' + i + '</option>');
                    //     }
                    //     console.log('Walk-in registration only for 15');
                    // }
                } else if (category === 'stock-car class c') {
                    // Early bird registration
                    if (currentDate <= new Date('2024-09-15 23:59:59')) {
                        for (var i = 1; i <= 5; i++) {
                            registrationSelect.append('<option value="' + i + '">' + i + '</option');
                        }
                        console.log('Early bird registration just 5')
                    }
                    // Pre-event online registration
                    if (currentDate >= new Date('2024-08-01 00:00:00') && currentDate < new Date('2024-09-21 23:59:59')) {
                        for (var i = 1; i <= 5; i++) {
                            registrationSelect.append('<option value="' + i + '">' + i + '</option');
                        }
                        console.log('Pre-event online registration just 5')
                    }
                    // Walk-in registration
                    // if (currentDate >= new Date('2024-12-02 00:00:00') && currentDate < new Date('2024-12-03 23:59:59')) {
                    //     for (var i = 1; i <= 5; i++) {
                    //         registrationSelect.append('<option value="' + i + '">' + i + '</option');
                    //     }
                    //     console.log('Walk-in registration just 5')
                    // }
                }
            }

            // Attach change event listener to the category input
            $("input[name='category']").change(updateRegistrationOptions);

            // Call the function on page load
            updateRegistrationOptions();

            $("#section_c").hide();

            // Initialize Select2 for the initial registration slot selection
            $("#registrationSlot").select2();

            // Create an object to store the validation rules and messages
            var validationRules = {
                full_name: {
                    required: true
                },
                identification_card_number: {
                    required: true
                },
                phone_number: {
                    required: true
                },
                registration: {
                    required: true,
                    min: 1
                },
                // receipt: {
                //     required: true
                // }
            };

            var validationMessages = {
                full_name: "Sila isi nama penuh anda.",
                identification_card_number: "Sila isi nombor Kad Pengenalan anda.",
                phone_number: "Sila isi nombor telefon anda.",
                // receipt: "Please upload the receipt here."
            };

            // Initialize form validation
            $('#racer_register').validate({
                errorElement: "span",
                errorClass: "is-invalid",
                rules: validationRules,
                messages: validationMessages,
                errorPlacement: function (error, element) {
                    error.appendTo(element.closest(".form-control").siblings(".invalid-feedback"));
                }
            });


            // Function to initialize Select2 for merchandise options with 100% width
            function initializeSelect2ForMerchandise() {
                for (var i = 0; i < 100; i++) { // Assuming a maximum of 10 merchandise options
                    $("#merchandise_" + i).select2({
                        width: '100%' // Set width to 100%
                    });
                }
            }

            var lastNum = {{ $lastNum ?? 0 }};
            console.log('Last number for {{--{{ $category['category'] }}--}}', lastNum);

            if( lastNum < 250 ){
                console.log('Less than 150')
            } else {
                $('#section_banner, #section_b, #section_c, #payment').remove();
                $('#section_a').empty();
                $("#section_a").append(
                    '<div class="card-body">' +
                    '<div id="merchandise_" class="text-center">' +
                    '<h2>Registration already close</h2>' +
                    '<h2>See your next year!!!</h2>' +
                    '</div>' +
                    '</div>'
                );
            }

            // Listen for changes in the registration slot selection
            $("#registrationSlot").change(function () {
                // Get the selected quantity
                var selectedQuantity = parseInt($(this).val()); // Convert to integer
                var nicknameInput = $("[name='nickname']");
                var nickname = nicknameInput.val().toUpperCase();
                var category = $("[name='category']").val();

                // Clear the existing merchandise options
                $("#merchandise_").empty();

                // Clear the Section C - Merchandise
                $("#section_c").empty();

                // Add the Section C - Merchandise structure
                $("#section_c").append(
                    '<div class="card-body">' +
                    '<h5 class="font-weight-700">Section C - Race ID</h5>' +
                    '<hr class="my-10px">' +
                    '<div id="merchandise_"></div>' +
                    '</div>'
                );

                {{--if (category !== "stock-car class c") {--}}
                {{--    // Add the Section C - Merchandise structure with image--}}
                {{--    $("#section_c").append(--}}
                {{--        '<div class="card-body">' +--}}
                {{--        '<h5 class="font-weight-700">Section C - Merchandise</h5>' +--}}
                {{--        '<hr class="my-10px">' +--}}
                {{--        '<img src="{{ asset('assets/images/mini-4wd/mhx2024_mini_4wd_cup_shirt.png') }}" alt="" class="img-fluid mb-3">' +--}}
                {{--        '<div id="merchandise_"></div>' +--}}
                {{--        '</div>'--}}
                {{--    );--}}
                {{--} else {--}}
                {{--    // Add the Section C - Merchandise structure without image--}}
                {{--    $("#section_c").append(--}}
                {{--        '<div class="card-body">' +--}}
                {{--        '<h5 class="font-weight-700">Section C - Race ID</h5>' +--}}
                {{--        '<hr class="my-10px">' +--}}
                {{--        '<div id="merchandise_"></div>' +--}}
                {{--        '</div>'--}}
                {{--    );--}}
                {{--}--}}

                var merchandiseOptions = '';
                for (var i = 0; i < selectedQuantity; i++) {
                    var paddedNumber = ("00" + (i + 1 + lastNum)).slice(-3); // Ensure it has at least 3 digits
                    var separator = (i === selectedQuantity - 1) ? '.' : ',';

                    merchandiseOptions += '<span for="merchandise_' + i + '" class="">' + nickname + paddedNumber + '</span>' +
                        '<input type="hidden" name="runNum[' + i + ']" value="' + paddedNumber + '">' + separator + ' ';
                }
                $("#merchandise_").append(merchandiseOptions);

                // if (category === "stock-car class c") {
                //     // Add merchandise options based on the selected quantity with label elements only
                //     var merchandiseOptions = '';
                //     for (var i = 0; i < selectedQuantity; i++) {
                //         var paddedNumber = ("00" + (i + 1 + lastNum)).slice(-3); // Ensure it has at least 3 digits
                //         var separator = (i === selectedQuantity - 1) ? '.' : ',';
                //
                //         merchandiseOptions += '<span for="merchandise_' + i + '" class="">' + nickname + paddedNumber + '</span>' +
                //             '<input type="hidden" name="runNum[' + i + ']" value="' + paddedNumber + '">' + separator + ' ';
                //     }
                //     $("#merchandise_").append(merchandiseOptions);
                // } else {
                    // Add merchandise options with select elements for other categories
                //     for (var i = 0; i < selectedQuantity; i++) {
                //         var paddedNumber = ("00" + (i + 1 + lastNum)).slice(-3); // Ensure it has at least 3 digits
                //         var divWrapper = (i === selectedQuantity - 1) ? '<div class="mb-0">' : '<div class="mb-3">';
                //
                //         $("#merchandise_").append(
                //             divWrapper +
                //             '<label for="merchandise_' + i + '" class="form-label">Select your shirt size ' + nickname + paddedNumber + '</label>' +
                //             '<select id="merchandise_' + i + '" class="form-control default-select2" name="merchandises[' + i + ']">' +
                //             '<option value="">Select an option</option>' +  // Add an empty option for validation
                //             '<option value="s">S</option>' +
                //             '<option value="m">M</option>' +
                //             '<option value="l">L</option>' +
                //             '<option value="xl">XL</option>' +
                //             '<option value="xxl">XXL (2XL)</option>' +
                //             '<option value="xxxl">XXXL (3XL)</option>' +
                //             '<option value="xxxxl">XXXXL (4XL)</option>' +
                //             '<option value="xxxxxl">XXXXXL (5XL)</option>' +
                //             '</select>' +
                //             '<input type="hidden" name="runNum[' + i + ']" value="' + paddedNumber + '">' +
                //             '</div>'
                //         );
                //     }
                // }

                // Initialize Select2 for merchandise options with 100% width
                initializeSelect2ForMerchandise();

                // Calculate the total cost and update the input field
                var priceCategory = parseFloat($("[name='price_category']").val()); // Convert to float
                var totalCost = selectedQuantity * priceCategory;
                $("[name='total']").val(totalCost); // Update the total cost input field

                // Show Section C - Merchandise when the user selects a quantity
                $("#section_c").show();
            });


            // Add custom validation method to ensure at least one merchandise option is selected
            $.validator.addMethod("select2Required", function (value, element) {
                return value !== null && value !== "";
            }, "Please select at least one merchandise option.");

            // Apply the custom validation method to the dynamically added select elements
            for (var i = 0; i < 10; i++) { // Assuming a maximum of 10 merchandise options
                $('#racer_register').validate().settings.rules["merchandise_" + i] = {
                    select2Required: true
                };
                $('#racer_register').validate().settings.messages["merchandise_" + i] = {
                    select2Required: "Please select at least one merchandise option for Team / Group " + (i + 1)
                };
            }

            // Initialize Select2 for merchandise options initially
            initializeSelect2ForMerchandise();

            // ============================================================

            // Initialize Clipboard.js
            var clipboard = new ClipboardJS('#copyLink', {
                text: function() {
                    return document.getElementById('textToCopy').value;
                }
            });

            // Prevent the link's default behavior (page refresh)
            /*document.getElementById('copyLink').addEventListener('click', function (e) {
                e.preventDefault();
            });*/

            // Add a success event listener
            clipboard.on('success', function(e) {
                console.log('Text copied to clipboard: ' + e.text);
                e.clearSelection();
            });

            // Add an error event listener
            clipboard.on('error', function(e) {
                console.error('Copy to clipboard failed: ' + e.action);
            });
        });

        function submitForm(formId) {
            var form = $('#' + formId);

            var category = form.find('[name="category"]').val();
            var price_category = form.find('[name="price_category"]').val();
            var total_cost = form.find('[name="total_cost"]').val();
            var full_name = form.find('[name="full_name"]').val();
            var identification_card_number = form.find('[name="identification_card_number"]').val();
            var phone_number = form.find('[name="phone_number"]').val();
            var email = form.find('[name="email"]').val();
            var nickname = form.find('[name="nickname"]').val();
            var team_group = form.find('[name="team_group"]').val();
            var registration = form.find('[name="registration"]').val();

            var merchandises = form.find('[name^="merchandises"]').map(function () {
                return $(this).val();
            }).get();

            var runNum = form.find('[name^="runNum"]').map(function () {
                return $(this).val();
            }).get();

            // Make the AJAX request
            $.ajax({
                url: '{{--{{ route('mhxcup.mhxCash') }}--}}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    category: category,
                    price_category: price_category,
                    total_cost: total_cost,
                    full_name: full_name,
                    identification_card_number: identification_card_number,
                    phone_number: phone_number,
                    email: email,
                    nickname: nickname,
                    team_group: team_group,
                    registration: registration,
                    merchandises: merchandises,
                    runNum: runNum,
                },
                /*success: function (response) {
                    if (response.status === true) {

                        $('#racer_register').remove();

                        var confirmationCodeHtml = `
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h2 class="text-center mb-0 mt-sm-0 mt-4 font-weight-700 text-uppercase">Confirmation Code</h2>
                                    <h1 class="text-center py-5">${response.data.uniq}</h1>
                                    <h4 class="text-center">
                                        Please take a screenshot of this code and show it to the counter for further processing to the next step.
                                    </h4>
                                </div>
                            </div>
                        `;
                        $('#confirm').append(confirmationCodeHtml);

                    } else {
                        console.error('Unexpected response status:', response.status);
                    }
                },
                error: function (error) {
                    console.error(error);
                }*/
            });
        }

    </script>
@endpush

@section('page-minicup')
<div class="container col-lg-4 text-center mr-sm-4">
    <img src="{{ asset('assets/images/maha/logo_maha_100yrs.png') }}" class="logo img-fluid">
</div>


    <div class="container p-sm-5 p-3">
        <div class="pb-5">
            <div class="row">
                <div id="confirm" class="col-md-6 mx-auto">
                    <form action="{{ route('qrcode') }}" method="GET" id="racer_register" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        {{--<div class="card mb-4" id="section_banner">
                             <div class="card-body">
                                @if($category['category'] == 'semi-tech class a')
                                    <img src="{{ asset('assets/images/mini-4wd/layout-semi-tech.jpeg') }}" alt="" class="img-fluid">
                                @elseif($category['category'] == 'b-max class b')
                                    <img src="{{ asset('assets/images/mini-4wd/layout-b-max.jpeg') }}" alt="" class="img-fluid">
                                @else
                                    <img src="{{ asset('assets/images/mini-4wd/layout-stock.jpeg') }}" alt="" class="img-fluid">
                                @endif
                            </div>
                        </div>--}}

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
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Media Sosial (Facebook, X, Instagram, etc.)</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Email dan Surat Khabar</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Kalendar Acara (Dalam Talian atau Fizikal)</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Iklan (Dalam Talian atau Luar Talian)</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Sokongan Selebriti atau Pempengaruh</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Buku atau Artikel</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Rakan, Keluarga atau Rakan Sekerja</label>
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

                        <div class="card mb-4" id="section_c">
                            <div class="card-body">
                                <h5 class="font-weight-700">Bahagian C - Jumlah Pembelian</h5>
                                <hr class="my-10px">

                                <div id="merchandise_">

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
