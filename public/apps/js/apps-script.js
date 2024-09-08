var Apps = {
    init: function () {
        Apps.applyPromoCode('#promo-code');
        Apps.createNewData();
        Apps.select2('.select2');
        Apps.socialMedia();
        Apps.getBoothType();
        Apps.getBooths();
        Apps.flatpickrDate('.flatpickr-start');
        Apps.flatpickrDate('.flatpickr-end');
        Apps.flatpickrTime('.flatpickr-time-start');
        Apps.flatpickrTime('.flatpickr-time-end');
        Apps.fancyApps();
        Apps.summernote('.text-editor');
    },

    applyPromoCode: function (idContainer) {
        var popUpTImer = 2000;

        $(idContainer + ' button.btn-promo').click(function (e) {
            e.preventDefault();
            var promoCodeUrl  = $(idContainer + ' input[name="promo_code_url"]').val();
            var promoCodeCsrf = $(idContainer + ' input[name="promo_code_csrf"]').val();
            var promoCode     = $(idContainer + ' input[name="promo_code"]').val();
            var sub_total     = $(idContainer + ' input[name="sub_total"]').val();
            var total         = $(idContainer + ' input[name="total"]').val();

            if (promoCode === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Promo Code',
                    text: 'Please enter a promo code.',
                    timer: popUpTImer,
                    customClass: {
                        confirmButton: "btn btn-warning"
                    }
                });
                return;
            }

            $.ajax({
                url: promoCodeUrl,
                type: 'POST',
                data: {
                    _token: promoCodeCsrf,
                    promo_code: promoCode,
                    sub_total: sub_total,
                    total: total
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Promo Code',
                        text: response.message,
                        timer: popUpTImer,
                        customClass: {
                            confirmButton: "btn btn-matec-blue"
                        }
                    });

                    console.log(response);

                    $(idContainer + ' input[name="promo_code"]').prop('disabled', true);

                    $('input[name="TRX_AMOUNT"]').val(parseFloat(response.new_total).toFixed(2));

                    $('input[name="CHECKOUT_DISCOUNT"]').val(parseFloat(response.discount).toFixed(2));
                    $('input[name="CHECKOUT_DISCOUNT_CODE"]').val(promoCode);

                    $('#checkout-view input[name="cart_total"]').val(parseFloat(response.new_total).toFixed(2));

                    var newTotalHtml = 'RM' + parseFloat(response.new_total).toFixed(2);

                    // Check if the coupon percentage is available and not null, otherwise handle as a fixed amount
                    var couponValue = '';
                    if (response.coupon) {
                        var formattedCoupon = parseFloat(response.coupon).toFixed(2);
                        formattedCoupon = parseFloat(formattedCoupon); // Remove the trailing .00 if it's an integer
                        couponValue = '(' + formattedCoupon + '%) ';
                    }

                    // Build the discount HTML based on whether it's a percentage or fixed amount
                    var discountHtml;
                    if (couponValue) {
                        // Percentage discount
                        discountHtml = '<dt class="col-6 fw-normal">Total Discount</dt>' +
                            '<dd class="col-6 text-end">' + couponValue + '- RM ' + parseFloat(response.discount).toFixed(2) + '</dd>';
                    } else {
                        // Fixed amount discount
                        discountHtml = '<dt class="col-6 fw-normal">Total Discount</dt>' +
                            '<dd class="col-6 text-end">- RM ' + parseFloat(response.discount).toFixed(2) + '</dd>';
                    }

                    $('#discount-details').html(discountHtml);
                    $('#checkout-view dd.total-display').html(newTotalHtml);
                },
                error: function (response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Promo Code',
                        text: response.responseJSON.error,
                        timer: popUpTImer,
                        customClass: {
                            confirmButton: "btn btn-danger"
                        }
                    });
                }
            });
        });
    },

    fancyApps: function () {
        Fancybox.bind('[data-fancybox]', {

        })
    },

    getBoothType: function () {
        $('#boothAreas').on('change', function() {
            var boothAreaId = $(this).val();
            console.log('Selected Booth Area ID:', boothAreaId);
            Apps.loadBoothTypes(boothAreaId);
        });
    },

    loadBoothTypes: function(boothAreaId, selectedBoothType = null) {
        var url = '';
        var userType = $('#boothAreas').data('user-type');

        if (userType === 'admin') {
            url = '/admin/get-booth-type';
        } else {
            url = '/organizer/event/get-booth-type';
        }

        if (boothAreaId) {
            $.ajax({
                url: url,
                type: "GET",
                data: { booth_area_id: boothAreaId },
                success: function(data) {
                    // console.log('Booth Types received:', data);
                    var boothTypeSelect = $('#boothTypes');
                    boothTypeSelect.empty();
                    boothTypeSelect.append('<option value="">Select Booth Type</option>');
                    $.each(data, function(key, value) {
                        var selected = value.id == selectedBoothType ? 'selected' : '';
                        boothTypeSelect.append('<option value="'+ value.id +'" '+ selected +'>'+ value.name +'</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        } else {
            $('#boothTypes').empty();
            $('#boothTypes').append('<option value="">Select Booth Type</option>');
        }
    },

    getBooths: function () {
        $('#boothTypes').on('change', function () {
            var boothTypeId = $(this).val();
            console.log('Selected Booth Type ID: ', boothTypeId)
            Apps.loadBooths(boothTypeId);
        })
    },

    loadBooths: function (boothTypeID, selectedBooth = null) {
        if (boothTypeID) {
            $.ajax({
                url: '/admin/get-booth',
                type: "GET",
                data: { booth_type_id: boothTypeID },
                success: function(response) {
                    console.log('Booths:', response.booths);
                    console.log('Prices:', response.prices);

                    var boothsListing = $('#boothsListing');
                    var boothsPricing = $('#boothsPricing');

                    // Clear previous content
                    boothsListing.empty();
                    boothsPricing.empty();

                    // Add booths section
                    boothsListing.append('<label for="booth_type" class="form-label">Booth</label>');
                    boothsListing.append('<div class="row gap-0">');

                    // Iterate over booths
                    $.each(response.booths, function (key, booth) {
                        var boothHTML = `
                            <div class="col-md-2 mb-md-0 mb-0">
                                <div class="form-check custom-option custom-option-icon">
                                    <label class="form-check-label custom-option-content" for="customCheckboxIcon${booth.id}">
                                        <span class="custom-option-body">
                                            <i class="ti ti-folder"></i>
                                            <span class="custom-option-title"> ${booth.booth_code} </span>
                                        </span>
                                        <input name="booths[]" class="form-check-input booth-checkbox" type="checkbox" value="${booth.id}" id="customCheckboxIcon${booth.id}" />
                                    </label>
                                </div>
                            </div>`;
                        boothsListing.find('.row').append(boothHTML);
                    });

                    boothsListing.append('</div>');

                    // Add price section
                    if (response.prices.length > 0) {
                        var price = response.prices[0].price; // Assuming there's one price object
                        var priceHTML = `
                            <div class="mb-3">
                                <label for="booth_type" class="form-label">Price Unit</label>
                                <input type="text" class="form-control" id="priceUnit" value="${price}" readonly>
                            </div>`;
                        boothsPricing.append(priceHTML);

                        // Append the total price section
                        boothsPricing.append('<div class="mb-3"><label for="totalPrice" class="form-label">Total Price</label><input type="text" class="form-control" id="totalPrice" value="0" readonly></div>');

                        // Add event listener to checkboxes
                        $('.booth-checkbox').on('change', function() {
                            Apps.getBoothPrice();
                        });

                    } else {
                        boothsPricing.append('<p>No pricing information available</p>');
                    }

                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error: ', error);
                }
            });
        } else {
            $('#boothsListing').empty().append('<p>There are no booths registered</p>');
            $('#boothsPricing').empty().append('<p>No pricing information available</p>');
        }
    },

    getBoothPrice: function() {
        var priceUnit = parseFloat($('#priceUnit').val());
        var selectedBoothsCount = $('.booth-checkbox:checked').length;
        var totalPrice = priceUnit * selectedBoothsCount;
        $('#totalPrice').val(totalPrice);
    },

    initBootyAreaType: function () {
        // Get the selected booth area and booth type from the response
        var selectedBoothArea = $('#boothAreas').val();
        var selectedBoothType = $('#boothTypes').data('selected'); // Ensure this data attribute is set in the response
        if (selectedBoothArea) {
            Apps.loadBoothTypes(selectedBoothArea, selectedBoothType);
        }
    },

    createNewData: function() {
        // Append modal HTML to the body if it doesn't exist
        if (!$('#basicModal').length) {
            $('body').append(`
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Content will be loaded here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary m-0" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `);
        }

        // Rebind the click event to handle dynamically loaded or existing buttons
        $(document).off('click', '[data-bs-toggle="modal"]').on('click', '[data-bs-toggle="modal"]', function() {
            var createUrl = $(this).data('create-url');
            var modalTitle = $(this).data('create-title');

            // Load content via AJAX
            $.ajax({
                url: createUrl,
                method: 'GET',
                success: function(response) {
                    $('#basicModal .modal-body').html(response);
                    $('#basicModal .modal-title').text(modalTitle);
                    $('#basicModal').modal('show'); // Show the modal
                    Apps.select2('.select2');
                    Apps.socialMedia();
                    Apps.flatpickrDate('.flatpickr-start');
                    Apps.flatpickrDate('.flatpickr-end');
                    Apps.flatpickrTime('.flatpickr-time-start');
                    Apps.flatpickrTime('.flatpickr-time-end');
                    Apps.summernote('.text-editor');
                    Apps.getBoothType();
                    Apps.getBooths();
                    Apps.initBootyAreaType();
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.status, xhr.statusText);
                    $('#basicModal .modal-body').html('<p>Error loading content...</p>');
                }
            });
        });
    },

    flatpickrDate: function (e) {
        var element = document.querySelector(e);
        if (element) {
            element.flatpickr({
                monthSelectorType: "static"
            });
        }
    },

    flatpickrTime: function (e) {
        var element = document.querySelector(e);
        if (element) {
            element.flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        }
    },

    summernote: function (e) {
        if ($(e).length) {
            $(e).summernote({
                height: "225"
            });
        } else {
            // console.error("Element does not exist or is null. Cannot initialize Summernote.");
        }
    },

    quill: function () {
        new Quill("#full-editor", {
            bounds: "#full-editor",
            placeholder: "Type Something...",
            modules: {
                formula: true,
                toolbar: [[{
                    font: []
                },
                    {
                        size: []
                    }], ["bold", "italic", "underline", "strike"], [{
                    color: []
                },
                    {
                        background: []
                    }], [{
                    script: "super"
                },
                    {
                        script: "sub"
                    }], [{
                    header: "1"
                },
                    {
                        header: "2"
                    },
                    "blockquote", "code-block"], [{
                    list: "ordered"
                },
                    {
                        list: "bullet"
                    },
                    {
                        indent: "-1"
                    },
                    {
                        indent: "+1"
                    }], [{
                    direction: "rtl"
                }], ["link", "image", "video", "formula"], ["clean"]]
            },
            theme: "snow"
        });
    },

    select2: function (select2) {
        $(select2).each(function() {
            const e = $(this);
            e.wrap('<div class="position-relative"></div>').select2({
                placeholder: "Select value",
                dropdownParent: e.parent()
            });
        });
    },

    editor: function (e) {
        new Quill(e, {
            bounds: e,
            placeholder: "Type Something...",
            modules: {
                formula: true,
                toolbar: [[{
                    font: []
                },
                    {
                        size: []
                    }], ["bold", "italic", "underline", "strike"], [{
                    color: []
                },
                    {
                        background: []
                    }], [{
                    script: "super"
                },
                    {
                        script: "sub"
                    }], [{
                    header: "1"
                },
                    {
                        header: "2"
                    },
                    "blockquote", "code-block"], [{
                    list: "ordered"
                },
                    {
                        list: "bullet"
                    },
                    {
                        indent: "-1"
                    },
                    {
                        indent: "+1"
                    }], [{
                    direction: "rtl"
                }], ["link", "image", "video", "formula"], ["clean"]]
            },
            theme: "snow"
        });
    },

    deleteConfirm: function(removeID) {
        Swal.fire({
            icon: 'warning',
            title: 'Delete this?',
            text: 'Are you sure you want to delete?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#e3342f',
        }).then((result) => {
            if (result.isConfirmed === true) {
                document.getElementById(removeID).submit();
            }
        });
    },

    logoutConfirm: function(removeID) {
        Swal.fire({
            icon: 'warning',
            title: 'Logout',
            text: 'Are you sure you want to logout?',
            showCancelButton: true,
            confirmButtonText: 'Yes, Log Out',
            confirmButtonColor: '#e3342f',
        }).then((result) => {
            if (result.isConfirmed === true) {
                document.getElementById(removeID).submit();
            }
        });
    },

    datatable: function () {
        var options = {
            dom: '<"row me-0"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            buttons: [{
                extend: "collection",
                className: "btn btn-label-secondary dropdown-toggle ms-3 waves-effect waves-light",
                text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
                buttons: [{
                    extend: "print",
                    text: '<i class="ti ti-printer me-2" ></i>Print',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                var s;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), s = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                }), s)
                            }
                        }
                    },
                    customize: function(e) {
                        $(e.document.body).css("color", s).css("border-color", t).css("background-color", a), $(e.document.body).find("table").addClass("compact").css("color", "inherit").css("border-color", "inherit").css("background-color", "inherit")
                    }
                }, {
                    extend: "csv",
                    text: '<i class="ti ti-file-text me-2" ></i>Csv',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                var s;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), s = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                }), s)
                            }
                        }
                    }
                }, {
                    extend: "excel",
                    text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                var s;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), s = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                }), s)
                            }
                        }
                    }
                }, {
                    extend: "pdf",
                    text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                var s;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), s = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                }), s)
                            }
                        }
                    }
                }, {
                    extend: "copy",
                    text: '<i class="ti ti-copy me-2" ></i>Copy',
                    className: "dropdown-item",
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        format: {
                            body: function(e, t, a) {
                                var s;
                                return e.length <= 0 ? e : (e = $.parseHTML(e), s = "", $.each(e, function(e, t) {
                                    void 0 !== t.classList && t.classList.contains("user-name") ? s += t.lastChild.firstChild.textContent : void 0 === t.innerText ? s += t.textContent : s += t.innerText
                                }), s)
                            }
                        }
                    }
                }]
            }, {
                text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New User</span>',
                className: "add-new btn btn-primary waves-effect waves-light",
                attr: {
                    "data-bs-toggle": "offcanvas",
                    "data-bs-target": "#offcanvasAddUser"
                }
            }],
            responsive: true,
            colReorder: true,
            keys: true,
            rowReorder: true,
            select: true
        };

        if ($(window).width() <= 767) {
            options.rowReorder = false;
            options.colReorder = false;
        }

        $('.data-table').DataTable(options);
    },

    swiperQuery: function (swiperSlides) {
        var s = document.querySelector(swiperSlides);
        if (s) {
            new Swiper(s, {
                slidesPerView: 3,
                spaceBetween: 10,
                pagination: {
                    clickable: true,
                    el: ".swiper-pagination"
                }
            });
        }
    },

    setEqualHeight: function (elements) {
        var maxHeight = 0;

        if ($(elements).length) {
            // Loop through each element to find the maximum height
            elements.each(function() {
                var currentHeight = $(this).height();
                if (currentHeight > maxHeight) {
                    maxHeight = currentHeight;
                }
            });

            // Set the maximum height to all div elements
            elements.height(maxHeight);
        }
    },

    socialMedia: function () {
        // Function to generate a new social link input group
        function generateSocialLinkInput(index) {
            return `
                    <div class="input-group mb-2">
                        <select name="social_link[platform][${index}]" class="form-select">
                            <option selected>Choose...</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Pinterest">Pinterest</option>
                            <option value="LinkedIn">LinkedIn</option>
                            <option value="YouTube">YouTube</option>
                            <option value="Reddit">Reddit</option>
                            <option value="Snapchat">Snapchat</option>
                            <option value="TikTok">TikTok</option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Telegram">Telegram</option>
                            <option value="LINE">LINE</option>
                            <option value="X">X</option>
                        </select>
                        <input name="social_link[url][${index}]" type="text" class="form-control w-50">
                        <button class="btn btn-danger btn-icon remove-field-button" type="button"><i class="ti ti-trash"></i></button>
                    </div>
                `;
        }

        // Initial index for new input groups
        let index = 1;

        // Event listener for adding a new input group
        $('.social-links-container').on('click', '.add-field-button', function() {
            const newInputGroup = generateSocialLinkInput(index);
            $('.social-links-container').append(newInputGroup);
            index++;
        });

        // Event listener for removing an input group
        $('.social-links-container').on('click', '.remove-field-button', function() {
            $(this).closest('.input-group').remove();
        });
    },
};

$(document).ready(function () {
    Apps.init();
});
