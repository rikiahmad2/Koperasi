<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Nasabah;

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
}
