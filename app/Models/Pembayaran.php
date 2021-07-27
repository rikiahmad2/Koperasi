<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = [
        "id_pembiayaan",
        "angsuran_ke",
        "nama_penyetor",
        "angsuran_bulan",
        "total_bayar"
    ];

    public function pembiayaan()
    {
        return $this->belongsTo('App\Models\PembiayaanModel', 'id_pembiayaan', 'id_pembiayaan');
    }
}
