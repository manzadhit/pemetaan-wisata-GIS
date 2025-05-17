<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Pariwisata;
use App\Models\JenisWisata;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PariwisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Pantai Nambo',
                'jenis' => 'Alam',
                'kecamatan' => 'Nambo',
                'alamat' => 'Kelurahan Nambo Kecamatan Nambo Kota Kendari',
                'latitude' => -4.000472,
                'longitude' => 122.617694,
                'deskripsi' => 'Pantai Nambo merupakan objek wisata andalan di Provinsi Sulawesi Tenggara. Pantai ini terletak di Kecamatan Abeli, kurang lebih 12 kilometer dari pusat Kota Kendari. Pantai berpasir putih nan halus di sepanjang bibir pantai dengan kondisi yang landai ini menjadi salah satu objek wisata favorit di Kota Kendari yang banyak dikunjungi oleh wisatawan. Tidak hanya wisatawan lokal, seringkali wisatawan asing juga singgah dan menikmati keindahan pantai ini.',
                'rating' => 4.1,
            ],
            [
                'nama' => 'Kendari Water Front City',
                'jenis' => 'Multifungsi (rekreasi, budaya, kuliner)',
                'kecamatan' => 'Abeli',
                'alamat' => 'Petoaha, Kecamatan Abeli, Kota Kendari',
                'latitude' => -3.984988,
                'longitude' => 122.603929,
                'deskripsi' => 'Kendari Waterfront City adalah inisiatif pengembangan kawasan pesisir yang bertujuan mengubah Teluk Kendari menjadi pusat pertumbuhan ekonomi, pariwisata, dan ruang publik yang berkelanjutan. Proyek ini mencerminkan upaya revitalisasi kota dengan memanfaatkan potensi geografis dan budaya lokal.',
                'rating' => 4.0,
            ],
            [
                'nama' => 'Wisata Anjungan Teluk Kendari',
                'jenis' => 'Multifungsi (Kuliner, Rekreasi, Hiburan)',
                'kecamatan' => 'Kendari Barat',
                'alamat' => 'Tipulu, Kec. Kendari Bar Kota Kendari',
                'latitude' => -3.967718,
                'longitude' => 122.552394,
                'deskripsi' => 'Anjungan Teluk Kendari (ATK) merupakan destinasi wisata modern yang terletak di Jalan Ir. H. Alala, Tipulu, Kecamatan Kendari Barat, Sulawesi Tenggara. Tempat ini menawarkan berbagai wahana hiburan, fasilitas kuliner, dan pemandangan indah Teluk Kendari, menjadikannya pilihan ideal untuk rekreasi keluarga maupun wisatawan.',
                'rating' => 4.3,
            ],
        ];

        foreach ($data as $wisata) {
            $jenis = JenisWisata::where('nama', $wisata['jenis'])->first();
            $kecamatan = Kecamatan::where('nama', $wisata['kecamatan'])->first();

            Pariwisata::create([
                'nama' => $wisata['nama'],
                'jenis_id' => $jenis->id ?? null,
                'kecamatan_id' => $kecamatan->id ?? null,
                'alamat' => $wisata['alamat'],
                'latitude' => $wisata['latitude'],
                'longitude' => $wisata['longitude'],
                'deskripsi' => $wisata['deskripsi'],
                'rating' => $wisata['rating'],
                'gambar' => null,
            ]);
        }
    }
}
