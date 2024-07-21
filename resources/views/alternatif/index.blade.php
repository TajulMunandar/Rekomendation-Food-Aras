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
                        Alternatif</button>
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
                        <th>Nilai Alternatif</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $alternatif)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $alternatif->kode }}</td>
                            <td>{{ $alternatif->nama }}</td>
                            <td>
                                @foreach ($alternatif->NilaiAlternatif as $nilaiAlternatif)
                                    <div class="d-flex justify-content-between lh-1">
                                        <div>
                                            {{ $nilaiAlternatif->kriteria->nama }} :
                                        </div>
                                        <div>
                                            {{ $nilaiAlternatif->nilai }}
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
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
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Data Alternatif</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('alternatif.destroy', $alternatif->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="">
                                            <p class="fs-5">Apakah anda yakin akan menghapus data
                                                <b>{{ $alternatif->nama }} ?</b>
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
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Alternatif</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="kode" class="form-label">Kode</label>
                                                <input type="text"
                                                    class="form-control @error('kode') is-invalid @enderror" id="kode"
                                                    name="kode" value="{{ old('kode', $alternatif->kode) }}">
                                                @error('kode')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                    name="nama" value="{{ old('nama', $alternatif->nama) }}">
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <span class="fw-bold ">Nilai Alternatif</span>
                                            <div class="row d-flex">
                                                @foreach ($alternatif->NilaiAlternatif as $nilaiAlternatif)
                                                    <div class="col col-4">
                                                        <div class="mb-3">
                                                            <label for="nilai_{{ $nilaiAlternatif->kriteria_id }}"
                                                                class="form-label">{{ $nilaiAlternatif->kriteria->nama }}</label>
                                                            <input type="number" step="0.01"
                                                                class="form-control @error('nilai.' . $nilaiAlternatif->kriteria_id) is-invalid @enderror"
                                                                id="nilai_{{ $nilaiAlternatif->kriteria_id }}"
                                                                name="nilai[{{ $nilaiAlternatif->kriteria_id }}]"
                                                                value="{{ old('nilai.' . $nilaiAlternatif->kriteria_id, $nilaiAlternatif->nilai) }}">
                                                            @error('nilai.' . $nilaiAlternatif->kriteria_id)
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endforeach
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
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Data Alternatif</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('alternatif.store') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="mb-4">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="name" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <span class="fw-bold ">Nilai Alternatif</span>
                                <div class="row d-flex">
                                    @foreach ($kriteria as $k)
                                        <div class="col col-4">
                                            <div class="mb-3">
                                                <label for="nilai-{{ $k->id }}"
                                                    class="form-label">{{ $k->nama }}</label>
                                                <input type="number" class="form-control"
                                                    id="nilai-{{ $k->id }}" step="0.01"
                                                    name="nilai_alternatif[{{ $k->id }}]">
                                            </div>
                                        </div>
                                    @endforeach
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
