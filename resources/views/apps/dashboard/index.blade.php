@extends('apps.layouts.app')

@section('title', 'Welcome Admin')
@section('description', '')
@section('keywords', '')

@push('style')

@endpush

@push('script')
    {{--<script src="{{ asset('apps/js/cards-statistics.js') }}"></script>--}}
    <script src="{{ asset('apps/js/cards-analytics.js') }}"></script>
    <script src="{{ asset('apps/js/cards-actions.js') }}"></script>
    <script src="{{ asset('apps/js/tables-datatables-advanced.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Set up the CSRF token in AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            function fetchVisitorData() {
                // First POST request to fetch total visitors and spending
                $.post('{{ route('maha.visitor.total') }}', function(data) {
                    const totalVisitors = data.total_visitor;
                    const totalSpending = data.total_spending;

                    // Process the data for daily visitors and spending from the 'months' array
                    const dailyVisitors = data.months.map(item => parseInt(item.total_visitors)); // Assuming 'total' represents the visitors count for that day
                    const dailySpending = data.months.map(item => parseFloat(item.total_spending)); // Assuming 'total' is the spending for that day
                    const dailyDates = data.months.map(item => new Date(item.date).toISOString().split('T')[0]);  // Format the 'created_at' date as 'YYYY-MM-DD'

                    // Render the charts after processing the data
                    renderCharts(totalVisitors, dailyVisitors, totalSpending, dailySpending, dailyDates);
                });
            }

            $.post('{{ route('maha.visitor.zone') }}', function (data) {
                const zone = data.zones;
                const visitor = data.visitor;
                const expenses = data.expenses;

                console.log(zone)
                console.log(visitor)
                console.log(expenses)
                zonesSummaries(zone, visitor, expenses)
            })

            function zonesSummaries(zones, spending, visitor) {
                var zonesSum = {
                    series: [{
                        name: 'Visitor',
                        data: spending
                    }, {
                        name: 'Spending',
                        data: visitor
                    }],
                    chart: {
                        height: 500,
                        type: 'area'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    xaxis: {
                        labels: {
                            rotate: -45
                        },
                        categories: zones
                    },
                    yaxis: {
                        title: {
                            text: 'Visitors'
                        }
                    }
                };

                var zoneChart = new ApexCharts(document.querySelector("#zoneChart"), zonesSum);
                zoneChart.render();
            }

            // zonesSummaries();

            function renderCharts(totalVisitors, dailyVisitors, totalSpending, dailySpending, dailyDates) {
                // Total Visitors Chart Configuration
                var totalVisitorsOptions = {
                    series: [{
                        name: 'Total Visitors',
                        data: [totalVisitors]
                    }],
                    chart: {
                        type: 'area'
                    },
                    stroke: {
                      curve: 'smooth'
                    },
                    xaxis: {
                        categories: ['Overall Visitors']
                    },
                    yaxis: {
                        title: {
                            text: 'Visitors'
                        }
                    }
                };

                // Daily Visitors Chart Configuration (using actual dates)
                var dailyVisitorsOptions = {
                    series: [{
                        name: 'Daily Visitors',
                        data: dailyVisitors  // Use the daily visitors data from 'total' in the data return
                    }],
                    chart: {
                        type: 'area'
                    },
                    stroke: {
                      curve: 'smooth'
                    },
                    xaxis: {
                        categories: dailyDates,  // Use the 'created_at' dates
                        title: {
                            text: 'Dates'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Visitors'
                        }
                    }
                };

                // Total Spending Chart Configuration
                var totalSpendingOptions = {
                    series: [{
                        name: 'Total Spending',
                        data: [totalSpending]
                    }],
                    chart: {
                        type: 'area'
                    },
                    stroke: {
                      curve: 'smooth'
                    },
                    xaxis: {
                        categories: ['Overall Spending']
                    },
                    yaxis: {
                        title: {
                            text: 'Spending (RM)'
                        }
                    }
                };

                // Daily Spending Chart Configuration
                var dailySpendingOptions = {
                    series: [{
                        name: 'Daily Spending',
                        data: dailySpending  // Use the daily spending data
                    }],
                    chart: {
                        type: 'area'
                    },
                    stroke: {
                      curve: 'smooth'
                    },
                    xaxis: {
                        categories: dailyDates,  // Use the same dates for daily spending
                        title: {
                            text: 'Dates'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Spending (RM)'
                        }
                    }
                };

                // Render each chart using ApexCharts
                var totalVisitorsChart = new ApexCharts(document.querySelector("#total-visitors-chart"), totalVisitorsOptions);
                totalVisitorsChart.render();

                var dailyVisitorsChart = new ApexCharts(document.querySelector("#daily-visitors-chart"), dailyVisitorsOptions);
                dailyVisitorsChart.render();

                var totalSpendingChart = new ApexCharts(document.querySelector("#total-spending-chart"), totalSpendingOptions);
                totalSpendingChart.render();

                var dailySpendingChart = new ApexCharts(document.querySelector("#daily-spending-chart"), dailySpendingOptions);
                dailySpendingChart.render();
            }

            // Call fetchVisitorData to start fetching data and rendering charts
            fetchVisitorData();


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

    <div class="row mb-4 gap-sm-0 gap-4">
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
                <div id="total-visitors-chart" style="height: 300px;"></div>
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
                <div id="daily-visitors-chart" style="height: 300px;"></div>
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
                    <small>Jumlah Keseluruhan Perbelanjaan</small>
                </div>
                <div id="total-spending-chart" style="height: 300px;"></div>
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
                    <small>Jumlah Perbelanjaan Hari Ini</small>
                </div>
                <div id="daily-spending-chart" style="height: 300px;"></div>
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
    <div class="row mb-sm-4 gap-sm-0 gap-4">

        <!-- Doughnut Chart -->
        <div class="col-lg-4 col-12">
            <div class="card">
                <h5 class="card-header">Jantina Peserta</h5>
                <div class="card-body">
                    <canvas id="myGenderChart" class="chartjs mb-6" data-height="350"></canvas>
                    <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                        <li class="ct-series-0 d-flex flex-column">
                            <h5 class="mb-0">Wanita</h5>
                            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(0, 102, 51);width:35px; height:6px;"></span>
                            <div class="text-muted">{{ $genderData['wanita'] }}</div>
                        </li>
                        <li class="ct-series-1 d-flex flex-column">
                            <h5 class="mb-0">Lelaki</h5>
                            <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(255, 255, 0);width:35px; height:6px;"></span>
                            <div class="text-muted">{{ $genderData['lelaki'] }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Earning Reports -->
        <div class="col-lg-8 col-12">
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
                    <div class="row gap-sm-0 gap-4 mb-4">
                        <div class="col-lg-6 col-sm-2 col-12">
                            <div class="card h-100 border border-success">
                                <div class="card-body text-center">
                                    <div class="badge rounded p-2 bg-label-danger mb-2">
                                        <i class="ti ti-users ti-lg"></i>
                                    </div>
                                    <h5 class="card-title mb-1 jumlah-peserta">0</h5>
                                    <p class="mb-0">Jumlah Peserta</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-2 col-12">
                            <div class="card h-100 border border-success">
                                <div class="card-body text-center">
                                    <div class="badge rounded p-2 bg-label-success mb-2">
                                        <i class="ti ti-shopping-cart ti-lg"></i>
                                    </div>
                                    <h5 class="card-title mb-1 jumlah-perbelanjaan">RM0.00</h5>
                                    <p class="mb-0">Jumlah Perbelanjaan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="zoneChart" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
