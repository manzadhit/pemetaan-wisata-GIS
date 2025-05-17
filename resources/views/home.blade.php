@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="text-center">
        <h1 class="mb-4">Selamat Datang di Sistem Informasi Tempat Wisata</h1>
        <p class="lead">Temukan informasi tempat wisata menarik di Kota Kendari secara interaktif!</p>

        <div class="mt-4">
            <a href="#" class="btn btn-success me-2">Lihat Peta Wisata</a>
            <a href="{{ route("pariwisata.index") }}" class="btn btn-primary">Daftar Wisata</a>
        </div>
    </div>

    <hr class="my-5">

    <div class="row text-center">
        <div class="col-md-4">
            <h4>📍 Pemetaan Interaktif</h4>
            <p>Lihat lokasi wisata langsung di peta dengan filter berdasarkan jenis dan wilayah.</p>
        </div>
        <div class="col-md-4">
            <h4>📋 Data Lengkap</h4>
            <p>Akses informasi detail tentang destinasi wisata favorit di sekitarmu.</p>
        </div>
        <div class="col-md-4">
            <h4>⭐ Penilaian & Rating</h4>
            <p>Lihat rating wisata dari pengunjung lain untuk menentukan pilihan terbaik.</p>
        </div>
    </div>
@endsection
