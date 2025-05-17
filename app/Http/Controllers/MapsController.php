<?php

namespace App\Http\Controllers;

use App\Models\JenisWisata;
use App\Models\Kecamatan;
use App\Models\Pariwisata;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function index()
    {
        $daftar_wisata = Pariwisata::latest()->get();
        $jenis_wisata  = JenisWisata::latest()->get();
        $daftar_kecamatan  = Kecamatan::latest()->get();
        return view('maps.index', compact('daftar_wisata', "jenis_wisata", "daftar_kecamatan"));
    }
}
