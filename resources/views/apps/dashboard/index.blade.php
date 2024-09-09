@extends('apps.layouts.app')

@section('title', 'Welcome Admin')
@section('description', '')
@section('keywords', '')

@push('style')

@endpush

@push('script')
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  console.log('test')
    // Get gender data from the controller
    var stateData = @json($statesdata);

    // Setup Chart.js bar chart
    var ctx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Johor', 'Kedah', 'Kelantan', 'Negeri Sembilan', 'Melaka', 'Pahang', 'Perak', 'Perlis', 'Pulau Pinang', 'Sarawak', 'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Sabah', 'Putrajaya'],
            datasets: [{
                label: 'Gender Distribution',
                data: [stateData.Johor, stateData.Kedah, stateData.Kelantan, stateData.NegeriSembilan, stateData.Melaka, stateData.Pahang, stateData.Perak, stateData.Perlis, stateData.Pulau Pinang, stateData.Sarawak, stateData.Selangor, stateData.Terengganu, stateData.Kuala Lumpur, stateData.Labuan, stateData.Sabah, stateData.Putrajaya],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)', 
                    'rgba(255, 99, 132, 0.2)',  
                    'rgba(255, 206, 86, 0.2)' ,  
                    'rgba(54, 162, 235, 0.2)', 
                    'rgba(255, 99, 132, 0.2)',  
                    'rgba(255, 206, 86, 0.2)',   
                    'rgba(54, 162, 235, 0.2)', 
                    'rgba(255, 99, 132, 0.2)', 
                    'rgba(255, 206, 86, 0.2)' ,  
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)',  
                    'rgba(255, 206, 86, 0.2)' ,  
                    'rgba(54, 162, 235, 0.2)', 
                    'rgba(255, 99, 132, 0.2)',  
                    'rgba(255, 206, 86, 0.2)' ,  
                    'rgba(54, 162, 235, 0.2)', 
                    
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',   
                    'rgba(255, 99, 132, 1)',    
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)',   
                    'rgba(255, 99, 132, 1)',    
                    'rgba(255, 206, 86, 1)' ,   
                    'rgba(54, 162, 235, 1)',   
                    'rgba(255, 99, 132, 1)',    
                    'rgba(255, 206, 86, 1)' ,   
                    'rgba(54, 162, 235, 1)',   
                    'rgba(255, 99, 132, 1)',    
                    'rgba(255, 206, 86, 1)' ,   
                    'rgba(54, 162, 235, 1)',   
                    'rgba(255, 99, 132, 1)',    
                    'rgba(255, 206, 86, 1)' ,   
                    'rgba(54, 162, 235, 1)',   
                             
                ],
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
});

@endpush

@section('content')
<!-- Bar Charts -->
<div class="col-xl-6 col-12 mb-6">
    <div class="card">
      <div class="card-header header-elements">
        <h5 class="card-title mb-0">Negeri</h5>
        <div class="card-action-element ms-auto py-0">
          <div class="dropdown">
            <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-calendar"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Hari Ini</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Kelmarin</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">7 Hari yang lalu</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">30 Hari yang lalu</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Bulan Ini</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Bulan Lepas</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <canvas id="barChart" class="chartjs" data-height="400"></canvas>
      </div>
    </div>
  </div>
  <!-- /Bar Charts -->

@endsection
