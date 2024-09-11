@extends('apps.layouts.app')

@section('title', 'Welcome Admin')
@section('description', '')
@section('keywords', '')

@push('style')

@endpush

@push('script')
    <script src="{{ asset('apps/js/cards-statistics.js') }}"></script>
    <script src="{{ asset('apps/js/cards-analytics.js') }}"></script>
    <script src="{{ asset('apps/js/cards-actions.js') }}"></script>
    <script src="{{ asset('apps/js/tables-datatables-advanced.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#statesQuery').on('change', function() {
                var selectedDate = $(this).val(); // Get the selected date
                $.ajax({
                    url: "{{ route('maha.state.data') }}", // Route to fetch data
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // CSRF token for security
                        start_date: selectedDate
                    },
                    success: function(response) {
                        // Update the chart with the new data
                        updateChart(response.statesdata);
                    },
                    error: function(xhr) {
                        console.error("An error occurred: " + xhr.status + " " + xhr.statusText);
                    }
                });
            });

            // Data returned from the controller
            var stateData = @json($statesdata);
            var labels = ['Johor', 'Kedah', 'Kelantan', 'Negeri Sembilan', 'Melaka', 'Pahang', 'Perak', 'Perlis', 'Pulau Pinang', 'Sarawak', 'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Sabah', 'Putrajaya'];
            var dataValues = labels.map(function(label) {
                return stateData[label];
            });

            // Bar chart configuration
            var ctx = $('#myBarChart')[0].getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Negeri',
                        data: dataValues, // Populated data from stateData
                        backgroundColor: 'rgb(0, 102, 51)',
                        borderColor: 'rgb(255, 255, 255)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Function to update the chart with new data
            function updateChart(newStateData) {
                var updatedDataValues = labels.map(function(label) {
                    return newStateData[label];
                });

                myBarChart.data.datasets[0].data = updatedDataValues;
                myBarChart.update();
            }

            // Make an AJAX request to fetch gender data on page load
            $.ajax({
                url: "{{ route('maha.gender.data') }}", // Route to fetch gender data
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}" // CSRF token for security
                },
                success: function(response) {
                    // Update the chart with the returned gender data
                    updateGenderChart(response.genderData);
                },
                error: function(xhr) {
                    console.error("An error occurred: " + xhr.status + " " + xhr.statusText);
                }
            });

            // Gender chart configuration (to be updated with fetched data)
            var ctx = $('#myGenderChart')[0].getContext('2d');
            var myGenderChart = new Chart(ctx, {
                type: 'pie', // You can choose other chart types if needed
                data: {
                    labels: ['Male', 'Female'], // Labels for gender
                    datasets: [{
                        label: 'Gender Distribution',
                        data: [0, 0], // Initial data, to be updated dynamically
                        backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'], // Colors for male and female
                        borderColor: 'rgb(255, 255, 255)',
                        borderWidth: 1
                    }]
                }
            });

            // Function to update the chart with new gender data
            function updateGenderChart(genderData) {
                // Assuming the response provides gender count in the format: { male: 100, female: 120 }
                myGenderChart.data.datasets[0].data = [genderData.male, genderData.female];
                myGenderChart.update();
            }

            function fetchDailySummaries() {
                var selectedZone = $('#queryzoneSelect').val();
                var selectedDate = $('#getSummariesbyDate').val();

                if (selectedZone || selectedDate) {
                    $.ajax({
                        url: "{{ route('maha.daily.summaries') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",  // Include CSRF token
                            zone_id: selectedZone ? selectedZone : null,  // If not selected, send null
                            date: selectedDate ? selectedDate : null      // If not selected, send null
                        },
                        success: function (response) {
                            $('.jumlah-peserta').text(response.visitorCount);
                            $('.jumlah-perbelanjaan').text('RM ' + parseFloat(response.totalSpending).toFixed(2));
                        },
                        error: function (xhr) {
                            console.error("An error occurred: " + xhr.status + " " + xhr.statusText);
                        }
                    });
                }
            }
            $('#queryzoneSelect').change(function () {
                fetchDailySummaries();
            });
            $('#getSummariesbyDate').change(function () {
                fetchDailySummaries();
            });
        });
    </script>
@endpush

@section('content')

    <div class="row mb-4">
        <!-- Subscriber Gained -->
        <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body pb-0">
                    <div class="card-icon">
                        <span class="badge bg-label-primary rounded p-2">
                            <i class='ti ti-users ti-26px'></i>
                        </span>
                    </div>
                    <h5 class="card-title mb-0 mt-2">{{ number_format($overallVisitorsCount) }}</h5>
                    <small>Jumlah Keseluruhan Peserta</small>
                </div>
                <div id="subscriberGained"></div>
            </div>
        </div>

        <!-- Subscriber Gained -->
        <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body pb-0">
                    <div class="card-icon">
                            <span class="badge bg-label-primary rounded p-2">
                                <i class='ti ti-users ti-26px'></i>
                            </span>
                    </div>
                    <h5 class="card-title mb-0 mt-2">{{ number_format($todayVisitorsCount) }}</h5>
                    <small>Jumlah Peserta Hari Ini</small>
                </div>
                <div id="subscriberGained"></div>
            </div>
        </div>


        <!-- Quarterly Sales -->
        <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body pb-0">
                    <div class="card-icon">
                        <span class="badge bg-label-danger rounded p-2">
                            <i class='ti ti-shopping-cart ti-26px'></i>
                        </span>
                    </div>
                    <h5 class="card-title mb-0 mt-2">RM {{ number_format($todaySpending, 2) }}</h5>
                    <small>Jumlah Keseluruhan Perbelanjaan</small>
                </div>
                <div id="quarterlySales"></div>
            </div>
        </div>

        <!-- Quarterly Sales -->
        <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="card h-100">
                <div class="card-body pb-0">
                    <div class="card-icon">
                            <span class="badge bg-label-danger rounded p-2">
                                <i class='ti ti-shopping-cart ti-26px'></i>
                            </span>
                    </div>
                    <h5 class="card-title mb-0 mt-2">RM {{ number_format($overallSpending, 2) }}</h5>
                    <small>Jumlah Perbelanjaan Hari Ini</small>
                </div>
                <div id="quarterlySales"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header header-elements">
                    <h5 class="card-title mb-0">Keseluruhan Negeri</h5>
                    <div class="card-action-element ms-auto py-0">
                        <input type="text" id="statesQuery" class="form-control flatpickr-start" placeholder="Select Date">
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Container Row -->
    <div class="row">

        <!-- Doughnut Chart -->
        <div class="col-lg-4 col-6">
            <div class="card">
                <h5 class="card-header">Jantina Peserta</h5>
                <div class="card-body">
                    <canvas id="myGenderChart" class="chartjs mb-6" data-height="350"></canvas>
                    <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                        <li class="ct-series-0 d-flex flex-column">
                            <h5 class="mb-0">Perempuan</h5>
                            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(0, 102, 51);width:35px; height:6px;"></span>
                            <div class="text-muted">{{ $genderData['female'] }}</div>
                        </li>
                        <li class="ct-series-1 d-flex flex-column">
                            <h5 class="mb-0">Lelaki</h5>
                            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(255, 255, 0);width:35px; height:6px;"></span>
                            <div class="text-muted">{{ $genderData['male'] }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Earning Reports -->
        <div class="col-lg-8 col-6">
            <div class="card h-100">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <div class="card-title">
                        <h5 class="mb-1">Summary</h5>
                        <p class="card-subtitle">Per Day Summary</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <select id="queryzoneSelect" class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option value="">Sila Pilih Zon</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}">
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card-action-element ms-auto py-0">
                                <input type="date" id="getSummariesbyDate" class="form-control flatpickr-end" placeholder="Select Date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-2 col-6">
                            <div class="card h-100 border border-success">
                                <div class="card-body text-center">
                                    <div class="badge rounded p-2 bg-label-danger mb-2">
                                        <i class="ti ti-users ti-lg"></i>
                                    </div>
                                    <h5 class="card-title mb-1 jumlah-peserta">{{--{{ $visitorCount }}--}}</h5> <!-- Class for visitor count -->
                                    <p class="mb-0">Jumlah Peserta</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-2 col-6">
                            <div class="card h-100 border border-success">
                                <div class="card-body text-center">
                                    <div class="badge rounded p-2 bg-label-success mb-2">
                                        <i class="ti ti-shopping-cart ti-lg"></i>
                                    </div>
                                    <h5 class="card-title mb-1 jumlah-perbelanjaan">RM {{--{{ number_format($totalSpending, 2) }}--}}</h5> <!-- Class for spending amount -->
                                    <p class="mb-0">Jumlah Perbelanjaan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
