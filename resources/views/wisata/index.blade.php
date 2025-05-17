@extends('layouts.app')

@section('title', 'Daftar Wisata')

@section('content')
<h1>Daftar Wisata</h1>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nama Wisata</th>
            <th>Jenis Wisata</th>
            <th>Kecamatan</th>
            <th>Alamat</th>
            <th>Deskripsi</th>
            <th>Rating</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftar_wisata as $index => $wisata)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if ($wisata->gambar)
                        <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="{{ $wisata->nama }}" width="100">
                    @else
                        <span class="text-muted">Tidak ada foto</span>
                    @endif
                </td>
                <td>{{ $wisata->nama }}</td>
                <td>{{ $wisata->jenis->nama }}</td>
                <td>{{ $wisata->kecamatan->nama }}</td>
                <td>{{ $wisata->alamat }}</td>
                <td>{{ Str::limit($wisata->deskripsi, 100, '...') }}</td>
                <td>{{ number_format($wisata->rating, 1) }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary">Detail</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">Data wisata tidak tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
