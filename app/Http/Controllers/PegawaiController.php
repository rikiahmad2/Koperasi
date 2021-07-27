<?php

namespace App\Http\Controllers;
use App\Models\Nasabah;
use App\Models\Pembayaran;
use App\Models\PembiayaanModel;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //
    public function index ()
    {
        return view('pegawai.dashboard');
    }

    public function manageNasabah()
    {
        $nasabahM = new Nasabah();
        $userM = new User();
        $data['data'] = $nasabahM->with('user')->get();
        $data['pengelola'] = $userM->get();

        return view('pegawai.managenasabah', $data);
    }

    public function managePembiayaan()
    {
        $pembiayaanM = new PembiayaanModel();
        $nasabahM = new Nasabah();
        $data['data'] = $pembiayaanM->with('nasabah', 'nasabah.user')->get();
        $data['nasabah'] = $nasabahM->get();

        return view('pegawai.pembiayaan', $data);
    }

    public function managePembayaran()
    {
        $nasabahM = new Nasabah();
        $data['data'] = Pembayaran::with('pembiayaan', 'pembiayaan.nasabah.user')->get();
        $data['nasabah'] = $nasabahM->get();

        return view('pegawai.pembayaran', $data);
    }
}
