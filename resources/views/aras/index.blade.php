<!-- resources/views/aras/index.blade.php -->
@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Rekomendasi Makanan dengan Metode ARAS</h1>
        <div class="card">
            <div class="card-body">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Pasien</th>
                            <th>Alternatif</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sortedAlternatifs as $alternatif)
                            <tr>
                                <td>{{ $pasien->User->name }}</td>
                                <td>{{ $alternatif->nama }}</td>
                                <td>{{ $finalValues[$alternatif->id] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
