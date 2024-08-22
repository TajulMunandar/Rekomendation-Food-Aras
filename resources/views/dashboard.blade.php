@extends('layouts.main')

@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h2 class="mb-0 text-dark">{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Aktivitas</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                            <i class="bi bi-briefcase fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold">{{ $aktivitas }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Kriteria</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary srounded-2">
                            <i class="bi bi-list-task fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold">{{ $kriteria }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Alternatif</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold">{{ $alternatif }}</h1>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">Nilai Alternatif</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                            <i class="bi bi-bullseye fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold">{{ $nilai }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2>Grafik Traffic</h2>
    <div class="card">
        <div class="card-body">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Traffic',
                    borderColor: "#8f44fd",
                    backgroundColor: "#8f44fd",
                    data: {!! json_encode($chartData) !!},
                    fill: true,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        suggestedMin: 0,
                        suggestedMax: 50,
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            color: "rgba(255, 255, 255, 0.08)",
                            borderColor: "transparent",
                            borderDash: [5, 5],
                            borderDashOffset: 2,
                            tickColor: "transparent"
                        },
                        beginAtZero: true
                    }
                },
                tension: 0.3,
                elements: {
                    point: {
                        radius: 8,
                        hoverRadius: 12,
                        backgroundColor: "#9BD0F5",
                        borderWidth: 0,
                    },
                },
            }
        });
    </script>
@endsection
