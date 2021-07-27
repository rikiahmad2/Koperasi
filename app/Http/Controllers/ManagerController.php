<?php

namespace App\Http\Controllers;
use App\Models\Nasabah;
use App\Models\Pembayaran;
use App\Models\PembiayaanModel;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    //
    public function index ()
    {
        return view('manager.dashboard');
    }

    public function manageAkun()
    {
        $userM = new User();
        $data['user'] = $userM->where('level', '!=', 'admin')->get();

        return view('manager.manageakun', $data);
    }

    public function manageNasabah()
    {
        $nasabahM = new Nasabah();
        $userM = new User();
        $data['data'] = $nasabahM->with('user')->get();
        $data['pengelola'] = $userM->get();

        return view('manager.managenasabah', $data);
    }

    public function managePembiayaan()
    {
        $pembiayaanM = new PembiayaanModel();
        $nasabahM = new Nasabah();
        $data['data'] = $pembiayaanM->with('nasabah', 'nasabah.user')->get();
        $data['nasabah'] = $nasabahM->get();

        return view('manager.pembiayaan', $data);
    }

    public function managePembayaran()
    {
        $nasabahM = new Nasabah();
        $data['data'] = Pembayaran::with('pembiayaan', 'pembiayaan.nasabah.user')->get();
        $data['nasabah'] = $nasabahM->get();

        return view('manager.pembayaran', $data);
    }
}
