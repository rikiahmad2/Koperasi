<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembiayaanModel extends Model
{
    use HasFactory;
    protected $table = 'pembiayaan';
    protected $primaryKey = 'id_pembiayaan';
    protected $fillable = [
        "no_rekening",
        "total_pinjaman",
        "jumlah_angsuran",
        "margin_keuntungan",
        "sisa_angsuran",
        "sisa_cicilan",
        "id_nasabah"
    ];

    public function nasabah()
    {
        return $this->belongsTo('App\Models\Nasabah', 'id_nasabah', 'id_nasabah');
    }
}
