<!DOCTYPE html>
<html lang="en">

<head>
    @include('../layouts/partial/head')
    <title>Sign Up </title>
    <style>
        body {
            background: linear-gradient(to right, #F6FB7A, #B4E380);
            font-family: "roboto"
        }
    </style>
</head>

<body class="bg-light">
    <!-- container -->
    <div class="container d-flex flex-column my-5">
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

                        <!-- Form -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf <!-- Laravel CSRF protection -->

                            <!-- name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                    placeholder=" Name" required="">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" id="username" class="form-control" name="username"
                                    placeholder="User Name" required="">
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- jk --}}
                            <div class="mb-3">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select id="jk" class="form-control" name="jk" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                @error('jk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="**************" required="">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation" placeholder="**************" required="">
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <!-- Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-warning text-white">
                                        Buat Akun Baru
                                    </button>
                                </div>

                                <div class="d-md-flex justify-content-between mt-4">
                                    <div class="mb-2 mb-md-0">
                                        <a href="/" class="fs-5">Sudah Ada Akun? Masuk</a>
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
