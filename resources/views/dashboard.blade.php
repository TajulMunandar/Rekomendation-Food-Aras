@extends('layouts.main')

@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h3 class="mb-0 text-dark">{{ $title }}</h3>
                    </div>
                    <div>
                        <a href="#" class="btn btn-dark">Create New Project</a>
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
                            <h4 class="mb-0">Projects</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                            <i class="bi bi-briefcase fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold">18</h1>
                        <p class="mb-0"><span class="text-dark me-2">2</span>Completed</p>
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
                            <h4 class="mb-0">Active Task</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary srounded-2">
                            <i class="bi bi-list-task fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold">132</h1>
                        <p class="mb-0"><span class="text-dark me-2">28</span>Completed</p>
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
                            <h4 class="mb-0">Teams</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold">12</h1>
                        <p class="mb-0"><span class="text-dark me-2">1</span>Completed</p>
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
                            <h4 class="mb-0">Productivity</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                            <i class="bi bi-bullseye fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold">76%</h1>
                        <p class="mb-0"><span class="text-success me-2">5%</span>Completed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row  -->
    <div class="row mt-6">
        <div class="col-md-12 col-12">
            <!-- card  -->
            <div class="card">
                <!-- card header  -->
                <div class="card-header bg-white  py-4">
                    <h4 class="mb-0">Active Projects</h4>
                </div>

                <div class="card-footer bg-white text-center">
                    <a href="#" class="link-primary">View All Projects</a>

                </div>
            </div>

        </div>
    </div>
    <!-- row  -->
@endsection
