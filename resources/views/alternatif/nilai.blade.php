@extends('layouts.main')

@section('content')
    @include('layouts.partial.breadcrumb')
    @include('layouts.partial.notif')

    <div class="mt-4 h-full">
        <div class="text-4xl font-bold text-primary-100">
            <p>{{ $alternatif->nama }}</p>
        </div>
        <hr class="my-2">
        <div class="flex flex-col justify-between">
            <form id="form_nilai" action="{{ route('alternatif.nilai.update', ['kode' => $alternatif->kode]) }}"
                class="grid grid-cols-3 gap-2" method="post">
                @csrf
                <input type="text" name="kode" value="{{ $alternatif->kode }}" hidden>
                <input type="text" name="nama" value="{{ $alternatif->nama }}" hidden>
                @if ($errors->any())
                    @foreach ($alternatif->nilai as $item)
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-light">{{ $item['nama_kriteria'] }}</p>
                            <input class="rounded-md" type="number" step="0.1" name="{{ $item['kode_kriteria'] }}"
                                value="{{ old($item['kode_kriteria']) }}">
                        </div>
                    @endforeach
                @else
                    @foreach ($alternatif->nilai as $item)
                        <div class="flex flex-col gap-2">
                            <p class="text-sm font-light">{{ $item['nama_kriteria'] }}</p>
                            <input class="rounded-md" type="number" step="0.1" name="{{ $item['kode_kriteria'] }}"
                                value="{{ $item['nilai'] }}">
                        </div>
                    @endforeach
                @endif
            </form>
            <div class="mt-4 flex justify-end">
                <button class="bg-primary-100 hover:bg-primary-200 p-1 px-2 font-bold text-white rounded-md" onclick="document.getElementById('form_nilai').submit()">Simpan</button>
            </div>
        </div>
    </div>
@endsection
