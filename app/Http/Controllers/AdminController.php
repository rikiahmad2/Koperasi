<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index ()
    {
        return view('admin.dashboard');
    }

    public function manageAkun()
    {
        $userM = new User();
        $data['user'] = $userM->get();

        return view('admin.manageakun', $data);
    }

    public function tambahAkun(Request $request)
    {
        $data =  $request->all();
        $data['password'] = Hash::make($data['password']);
        $userM = new User();
        $userM->nip = $data['nip'];
        $userM->name = $data['name'];
        $userM->email = $data['email'];
        $userM->alamat = $data['alamat'];
        $userM->jenis_kelamin = $data['jenis_kelamin'];
        $userM->level = $data['level'];
        $userM->password = $data['password'];

        $userM->save();
        return redirect()->back()->with('tambah', 'data berhasil di tambah');
    }

    public function deleteAkun($id)
    {
        $userM = User::find($id);
        $userM->delete();
        return redirect()->back()->with('delete', 'data berhasil di delete');
    }

    public function editAkun(Request $request)
    {
        $data =  $request->all();
        if($request->password != null){
            $data['password'] = Hash::make($data['password']);
        }
        

        $userM = User::find($request->id);
        $userM->nip = $data['nip'];
        $userM->name = $data['name'];
        $userM->email = $data['email'];
        $userM->alamat = $data['alamat'];
        $userM->jenis_kelamin = $data['jenis_kelamin'];
        $userM->level = $data['level'];
        
        if($request->password != null){
            $userM->password = $data['password'];
        }
        $userM->save();
        return redirect()->back()->with('edit', 'data berhasil di delete');
        
    }

    public function manageNasabah()
    {
        $nasabahM = new Nasabah();
        $userM = new User();
        $data['data'] = $nasabahM->with('user')->get();
        $data['pengelola'] = $userM->get();

        return view('admin.managenasabah', $data);
    }

    public function tambahNasabah(Request $request)
    {
        $data =  $request->all();

        $nasabahM = new Nasabah();
        $nasabahM->name = $data['name'];
        $nasabahM->noidentitas = $data['noidentitas'];
        $nasabahM->ttl = $data['ttl'];
        $nasabahM->jenis_kelamin = $data['jenis_kelamin'];
        $nasabahM->agama = $data['agama'];
        $nasabahM->pekerjaan = $data['pekerjaan'];
        $nasabahM->pendidikan = $data['pendidikan'];
        $nasabahM->no_hp = $data['no_hp'];
        $nasabahM->alamat = $data['alamat'];
        $nasabahM->kelurahan = $data['kelurahan'];
        $nasabahM->kecamatan = $data['kecamatan'];
        $nasabahM->provinsi = $data['provinsi'];
        $nasabahM->user_id = $data['user_id'];

        $nasabahM->save();
        return redirect()->back()->with('tambah', 'data berhasil di tambah');
    }

    public function deleteNasabah($id)
    {
        $nasabahM = Nasabah::find($id);
        $nasabahM->delete();
        return redirect()->back()->with('delete', 'data berhasil di delete');
    }

    public function editNasabah(Request $request)
    {
        $data =  $request->all();

        $nasabahM = Nasabah::find($request->id_nasabah);
        $nasabahM->name = $data['name'];
        $nasabahM->noidentitas = $data['noidentitas'];
        $nasabahM->ttl = $data['ttl'];
        $nasabahM->jenis_kelamin = $data['jenis_kelamin'];
        $nasabahM->agama = $data['agama'];
        $nasabahM->pekerjaan = $data['pekerjaan'];
        $nasabahM->pendidikan = $data['pendidikan'];
        $nasabahM->no_hp = $data['no_hp'];
        $nasabahM->alamat = $data['alamat'];
        $nasabahM->kelurahan = $data['kelurahan'];
        $nasabahM->kecamatan = $data['kecamatan'];
        $nasabahM->provinsi = $data['provinsi'];
        $nasabahM->user_id = $data['user_id'];

        $nasabahM->save();
        return redirect()->back()->with('edit', 'data berhasil di delete');
    }
}
