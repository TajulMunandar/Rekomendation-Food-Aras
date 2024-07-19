<!DOCTYPE html>
<html lang="en">

<head>
    @include('../layouts/partial/head')
    <title>Sign In </title>
    <style>
        body {
            background: linear-gradient(to right, #F6FB7A, #B4E380);
            font-family: "roboto"
        }
    </style>
</head>

<body class="bg-light">
    <!-- container -->
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0
        min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
                <!-- Card -->
                <div class="card smooth-shadow-md">
                    <!-- Card body -->
                    <div class="card-body p-6">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <dotlottie-player
                                src="https://lottie.host/918b23bb-1723-4f9d-8b7c-c06cfbdc8598/OzhEfjKMFa.json"
                                background="transparent" speed="1" style="width: 250px; height: 250px;" loop
                                autoplay></dotlottie-player>
                        </div>
                        <div class="mb-4">
                            <p class="mb-3">Masukkan informasi akun anda!</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('failed'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('failed') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Form -->
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" id="username" class="form-control" name="username"
                                    placeholder="username here" required="">
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="**************" required="">
                            </div>
                            <!-- Checkbox -->
                            <div>
                                <!-- Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-warning text-white">Masuk</button>
                                </div>

                                <div class="d-md-flex justify-content-between mt-4">
                                    <div class="mb-2 mb-md-0">
                                        <a href="/daftar" class="fs-5">Belum Punya Akun? </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    @include('../layouts/partial/scripts')
</body>

</html>
