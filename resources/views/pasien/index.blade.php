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
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah
                        Pasien</button>
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
                        <th>User</th>
                        <th>Aktivitas</th>
                        <th>Tinggi Badan</th>
                        <th>Berat Badan</th>
                        <th>Kolesterol</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pasien->User->name }}</td>
                            <td>{{ $pasien->Aktivitas->nama }}</td>
                            <td>{{ $pasien->tb }}</td>
                            <td>{{ $pasien->bb }}</td>
                            <td>{{ $pasien->kolesterol }}</td>
                            <td>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Data Pasien</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="">
                                            <p class="fs-5">Apakah anda yakin akan menghapus data
                                                <b>{{ $pasien->User->nama }} ?</b>
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

                        <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pasien</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">User</label>
                                                <select class="form-select" name="user_id" id="user_id">
                                                    @foreach ($users as $user)
                                                        @if (old('user_id', $pasien->user_id) == $user->id)
                                                            <option value="{{ $user->id }}" selected>
                                                                {{ $user->name }}</option>
                                                        @else
                                                            <option value="{{ $user->id }}">
                                                                {{ $user->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="aktivitas_id" class="form-label">Aktivitas</label>
                                                <select class="form-select" name="aktivitas_id" id="aktivitas_id">
                                                    @foreach ($aktivitases as $aktivitas)
                                                        @if (old('aktivitas_id', $pasien->aktivitas_id) == $aktivitas->id)
                                                            <option value="{{ $aktivitas->id }}" selected>
                                                                {{ $aktivitas->name }}</option>
                                                        @else
                                                            <option value="{{ $aktivitas->id }}">
                                                                {{ $aktivitas->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tb" class="form-label">Tinggi Badan</label>
                                                <input type="number"
                                                    class="form-control @error('tb') is-invalid @enderror" id="tb"
                                                    name="tb" value="{{ old('tb', $pasien->tb) }}">
                                                @error('tb')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="bb" class="form-label">Berat Badan</label>
                                                <input type="number"
                                                    class="form-control @error('bb') is-invalid @enderror" id="bb"
                                                    name="bb" value="{{ old('bb', $pasien->bb) }}">
                                                @error('bb')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="kolesterol" class="form-label">Kolesterol</label>
                                                <input type="number"
                                                    class="form-control @error('kolesterol') is-invalid @enderror"
                                                    id="kolesterol" name="kolesterol"
                                                    value="{{ old('kolesterol', $pasien->kolesterol) }}">
                                                @error('kolesterol')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Data Pasien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('pasien.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">User</label>
                                    <select class="form-select" name="user_id" id="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="aktivitas_id" class="form-label">Aktivitas</label>
                                    <select class="form-select" name="aktivitas_id" id="aktivitas_id">
                                        @foreach ($aktivitases as $aktivitas)
                                            <option value="{{ $aktivitas->id }}">
                                                {{ $aktivitas->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tb" class="form-label">Tinggi Badan</label>
                                    <input type="number" class="form-control @error('tb') is-invalid @enderror"
                                        id="tb" name="tb">
                                    @error('tb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="bb" class="form-label">Berat Badan</label>
                                    <input type="number" class="form-control @error('bb') is-invalid @enderror"
                                        id="bb" name="bb">
                                    @error('bb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="kolesterol" class="form-label">Kolesterol</label>
                                    <input type="number" class="form-control @error('kolesterol') is-invalid @enderror"
                                        id="kolesterol" name="kolesterol">
                                    @error('kolesterol')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
