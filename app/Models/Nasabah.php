<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'nasabah';
    protected $primaryKey = 'id_nasabah';
    protected $fillable = [
        "name",
        "noidentitas",
        "ttl",
        "jenis_kelamin",
        "agama",
        "pekerjaan",
        "no_hp",
        "alamat",
        "kelurahan",
        "kecamatan",
        "provinsi",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
