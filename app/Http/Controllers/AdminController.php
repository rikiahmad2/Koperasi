<?php

namespace App\Http\Controllers;
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
}
