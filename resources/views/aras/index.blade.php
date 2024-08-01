<!-- resources/views/aras/index.blade.php -->
@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Rekomendasi Makanan dengan Metode ARAS</h1>

        <div class="card mt-2">
            <div class="card-body">
                <h3>Decision Matrix</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteria as $k)
                                <th>{{ $k->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($decisionMatrix as $altId => $nilaiKriteria)
                            <tr>
                                <td>{{ $alternatifs->where('id', $altId)->first()->nama ?? 'Alternatif 0' }}</td>
                                @foreach ($kriteria as $k)
                                    <td>{{ $nilaiKriteria[$k->id] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h3>Normalized Matrix</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteria as $k)
                                <th>{{ $k->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($normalizedMatrix as $altId => $nilaiKriteria)
                            <tr>
                                <td>{{ $alternatifs->where('id', $altId)->first()->nama ?? 'Alternatif 0' }}</td>
                                @foreach ($kriteria as $k)
                                    <td>{{ $nilaiKriteria[$k->id] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h3>Weighted Matrix</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteria as $k)
                                <th>{{ $k->nama }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($weightedMatrix as $altId => $nilaiKriteria)
                            <tr>
                                <td>{{ $alternatifs->where('id', $altId)->first()->nama ?? 'Alternatif 0' }}</td>
                                @foreach ($kriteria as $k)
                                    <td>{{ $nilaiKriteria[$k->id] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h3>Final Values</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finalValues as $altId => $value)
                            <tr>
                                <td>{{ $alternatifs->where('id', $altId)->first()->nama ?? 'Alternatif 0' }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h3>Sorted Alternatives</h3>
                <table class="table table-striped">
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
