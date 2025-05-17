<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pariwisata extends Model
{
    protected $table = "pariwisata";

    public function jenis() {
        return $this->belongsTo(JenisWisata::class, "jenis_id");
    }

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, "kecamatan_id");
    }
}
