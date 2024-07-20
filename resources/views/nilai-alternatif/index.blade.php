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
                        <th>Alternatif</th>
                        <th>Kriteria</th>
                        <th>Nilai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilais as $nilai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $nilai->Alternatif->kode }} - {{ $nilai->Alternatif->nama }}</td>
                            <td>{{ $nilai->Kriteria->kode }} - {{ $nilai->Kriteria->nama }}</td>
                            <td>{{ $nilai->nilai }}</td>
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
                                    <form action="{{ route('nilai-alternatif.destroy', $nilai->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="">
                                            <p class="fs-5">Apakah anda yakin akan menghapus data
                                                <b>{{ $nilai->Alternatif->kode }} - {{ $nilai->Alternatif->nama }} ?</b>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Nilai Alternatif</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('nilai-alternatif.update', $nilai->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="alternatif_id" class="form-label">Alternatif</label>
                                                <select class="form-select" name="alternatif_id" id="alternatif_id">
                                                    @foreach ($alternatifs as $alternatif)
                                                        @if (old('alternatif_id', $nilai->alternatif_id) == $alternatif->id)
                                                            <option value="{{ $alternatif->id }}" selected>
                                                                {{ $alternatif->kode }} - {{ $alternatif->nama }}</option>
                                                        @else
                                                            <option value="{{ $alternatif->id }}">
                                                                {{ $alternatif->kode }} - {{ $alternatif->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kriteria_id" class="form-label">Aktivitas</label>
                                                <select class="form-select" name="kriteria_id" id="kriteria_id">
                                                    @foreach ($kriterias as $kriteria)
                                                        @if (old('kriteria_id', $nilai->kriteria_id) == $kriteria->id)
                                                            <option value="{{ $kriteria->id }}" selected>
                                                                {{ $kriteria->kode }} - {{ $kriteria->nama }}</option>
                                                        @else
                                                            <option value="{{ $kriteria->id }}">
                                                                {{ $kriteria->kode }} - {{ $kriteria->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nilai" class="form-label">Nilai</label>
                                                <input type="number"
                                                    class="form-control @error('nilai') is-invalid @enderror"
                                                    id="nilai" name="nilai"
                                                    value="{{ old('nilai', $nilai->nilai) }}">
                                                @error('nilai')
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
                        <form action="{{ route('nilai-alternatif.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="alternatif_id" class="form-label">Alternatif</label>
                                    <select class="form-select" name="alternatif_id" id="alternatif_id">
                                        @foreach ($alternatifs as $alternatif)
                                            <option value="{{ $alternatif->id }}">
                                                {{ $alternatif->kode }} - {{ $alternatif->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kriteria_id" class="form-label">Aktivitas</label>
                                    <select class="form-select" name="kriteria_id" id="kriteria_id">
                                        @foreach ($kriterias as $kriteria)
                                            <option value="{{ $kriteria->id }}">
                                                {{ $kriteria->kode }} - {{ $kriteria->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai" class="form-label">Nilai</label>
                                    <input type="number" class="form-control @error('nilai') is-invalid @enderror"
                                        id="nilai" name="nilai">
                                    @error('nilai')
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
