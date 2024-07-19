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
                        Kriteria</button>
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
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Bobot</th>
                        <th>Atribut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriterias as $kriteria)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kriteria->kode }}</td>
                            <td>{{ $kriteria->nama }}</td>
                            <td>{{ $kriteria->bobot }}</td>
                            <td>
                                @if ($kriteria->atribut == 'benefit')
                                    <span class="badge bg-success">Benefit</span>
                                @else
                                    <span class="badge bg-warning">Cost</span>
                                @endif
                            </td>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Data Kriteria</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="">
                                            <p class="fs-5">Apakah anda yakin akan menghapus data
                                                <b>{{ $kriteria->nama }} ?</b>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kriteria</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="kode" class="form-label">Kode</label>
                                                <input type="text"
                                                    class="form-control @error('kode') is-invalid @enderror" id="kode"
                                                    name="kode" value="{{ old('kode', $kriteria->kode) }}">
                                                @error('kode')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="name"
                                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                    name="nama" value="{{ old('nama', $kriteria->nama) }}">
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="bobot" class="form-label">Bobot</label>
                                                <input type="number" step="0.01"
                                                    class="form-control @error('bobot') is-invalid @enderror"
                                                    id="bobot" name="bobot"
                                                    value="{{ old('bobot', $kriteria->bobot) }}">
                                                @error('bobot')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="atribut" class="form-label">Atribut</label>
                                                <select class="form-select @error('atribut') is-invalid @enderror"
                                                    name="atribut" id="atribut">
                                                    <option value="benefit"
                                                        {{ $kriteria->atribut == 'benefit' ? 'selected' : '' }}>
                                                        Benefit
                                                    </option>
                                                    <option value="cost"
                                                        {{ $kriteria->atribut == 'cost' ? 'selected' : '' }}>
                                                        Cost
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Data Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('kriteria.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                        id="kode" name="kode">
                                    @error('kode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="name" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="bobot" class="form-label">Bobot</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('bobot') is-invalid @enderror" id="bobot"
                                        name="bobot">
                                    @error('bobot')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="atribut" class="form-label">Atribut</label>
                                    <select class="form-select @error('atribut') is-invalid @enderror" name="atribut"
                                        id="atribut">
                                        <option value="benefit">
                                            Benefit
                                        </option>
                                        <option value="cost">
                                            Cost
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
