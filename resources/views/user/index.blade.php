@extends('layouts.main')

@section('content')
    <div class="row mt-3">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-12 mb-3">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="mb-2 mb-lg-0">
                    <h3 class="mb-0 text-dark fw-bold">{{ $title }}</h3>
                </div>
                <div>
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah User</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5">
        <div class="card-body">
            <table id="myTable" class="table text-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Jenis Kelamin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @if ($user->role == 'admin')
                                    <span class="badge bg-primary">Admin</span>
                                @elseif($user->role == 'user')
                                    <span class="badge bg-info">User</span>
                                @endif
                            </td>
                            <td>{{ $user->jk }}</td>
                            <td>
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#resetPassword{{ $loop->iteration }}">
                                    <i class="fa-solid fa-unlock-keyhole"></i>
                                </button>
                                <button id="edit-button" class="btn btn-warning text-white" id="edit-button"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $loop->iteration }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button id="delete-button" class="btn btn-danger" id="delete-button" data-bs-toggle="modal"
                                    data-bs-target="#hapusModal{{ $loop->iteration }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{--  MODAL DELETE  --}}
                        <div class="modal fade" id="hapusModal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Data User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="">
                                            <p class="fs-5">Apakah anda yakin akan menghapus data
                                                <b>{{ $user->name }} ?</b>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--  MODAL DELETE  --}}
                        {{-- modal reset --}}
                        <div class="modal fade" id="resetPassword{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('users.reset') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="hidden" name="id" value="{{ $user->id }}">

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password
                                                        Baru</label>
                                                    <div id="pwd1" class="input-group">
                                                        <input type="password"
                                                            class="form-control border-end-0 @error('password') is-invalid @enderror"
                                                            name="password" id="password" value="{{ old('password') }}"
                                                            required>
                                                        <span class="input-group-text cursor-pointer">
                                                            <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                                        </span>
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password2" class="form-label">Konfirmasi
                                                        Password
                                                        Baru</label>
                                                    <div id="pwd2" class="input-group">
                                                        <input type="password"
                                                            class="form-control border-end-0 @error('password2') is-invalid @enderror"
                                                            name="password2" id="password2"
                                                            value="{{ old('password2') }}" required>
                                                        <span class="input-group-text cursor-pointer">
                                                            <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                                                        </span>
                                                        @error('password2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark">Reset</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- modal reset --}}

                        <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('users.update', $user->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="Fakultas" class="form-label">Nama</label>
                                                <input type="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="name" name="name"
                                                    value="{{ old('name', $user->name) }}">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="name"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    id="username" name="username"
                                                    value="{{ old('username', $user->username) }}">
                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role</label>
                                                <select class="form-select @error('role') is-invalid @enderror"
                                                    name="role" id="role">
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                                        User
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                                <select class="form-select @error('jk') is-invalid @enderror"
                                                    name="jk" id="jk">
                                                    <option value="laki-laki"
                                                        {{ $user->jk == 'laki-laki' ? 'selected' : '' }}>
                                                        Laki-laki
                                                    </option>
                                                    <option value="perempuan"
                                                        {{ $user->jk == 'perempuan' ? 'selected' : '' }}>
                                                        Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning text-white">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Data User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="name" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="name" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select @error('role') is-invalid @enderror" name="role"
                                        id="role">
                                        <option value="admin">Admin
                                        </option>
                                        <option value="user">User
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jk" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select @error('jk') is-invalid @enderror" name="jk"
                                        id="jk">
                                        <option value="laki-laki">Laki-laki
                                        </option>
                                        <option value="perempuan">Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
