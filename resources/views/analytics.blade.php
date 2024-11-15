@extends('layouts.backend')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Start Breadcrumb -->
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <h1 class="h3 text-white">Analytics</h1>
        <ol class="breadcrumb bg-transparent small p-0">
            <li class="breadcrumb-item "><a href="./index.html" class="path-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Analytics</li>
        </ol>
    </nav>
</div>
<!-- End Breadcrumb -->

<!-- Main Div -->
<div class="row">
    <!-- Current Projects -->
    <div class="col-md-6 mb-4 mb-md-0">
        <div class="card h-100" style="background-color: #1d1d1d00;     border: none;">
            <div class="card-body bg-white" style="border-radius:40px;  ">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
    <!-- End Current Projects -->

    <!-- Comments -->
    <div class="col-md-6">
        <div class="card h-100" style="background-color:#1d1d1d00;border: none;">
            <div class="card-body bg-white" style="border-radius:40px;">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
    <!-- End Comments -->
</div>
<!-- End Main Div -->

<script>
    const linectx = document.getElementById('lineChart');
    new Chart(linectx, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                    label: 'Cancelled Booking',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                },
                {
                    label: 'Accepted Booking',
                    data: @json($total_bookings),
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ''
                }
            }
        },
    });

    const barctx = document.getElementById('barChart');
    new Chart(barctx, {
        type: 'bar',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                label: 'Total Bookings',
                data: @json($total_bookings),
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderWidth: 2,
                borderRadius: 5,
                borderSkipped: false,

            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ''
                }
            }
        },
    });
</script>
@endsection