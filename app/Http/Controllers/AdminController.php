<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Pembayaran;
use App\Models\PembiayaanModel;
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

    public function managePembiayaan()
    {
        $pembiayaanM = new PembiayaanModel();
        $nasabahM = new Nasabah();
        $data['data'] = $pembiayaanM->with('nasabah', 'nasabah.user')->get();
        $data['nasabah'] = $nasabahM->get();

        return view('admin.pembiayaan', $data);
    }

    public function tambahPembiayaan(Request $request)
    {
        $pembiayaanM = new PembiayaanModel();
        $data =  $request->all();

        $pembiayaanM->no_rekening = $data['no_rekening'];
        $pembiayaanM->total_pinjaman = $data['total_pinjaman'];
        $pembiayaanM->jumlah_angsuran = $data['jumlah_angsuran'];
        $pembiayaanM->sisa_angsuran = $data['jumlah_angsuran'];
        $pembiayaanM->margin_keuntungan = $data['margin_keuntungan'];
        
        $sisa_cicilan = $data['jumlah_angsuran']*$data['margin_keuntungan']*$data['total_pinjaman']/100+$data['total_pinjaman'];
        $pembiayaanM->sisa_cicilan = $sisa_cicilan;
        $pembiayaanM->cicilan_perbulan = $sisa_cicilan/$data['jumlah_angsuran'];
        $pembiayaanM->id_nasabah = $data['id_nasabah'];

        $pembiayaanM->save();
        return redirect()->back()->with('tambah', 'data berhasil di tambah');
    }

    public function deletePembiayaan($id)
    {
        $pembiayaanM = PembiayaanModel::find($id);
        $pembiayaanM->delete();
        return redirect()->back()->with('delete', 'data berhasil di delete');
    }

    public function editPembiayaan(Request $request)
    {
        $pembiayaanM = PembiayaanModel::find($request->id_pembiayaan);
        $data =  $request->all();

        $pembiayaanM->no_rekening = $data['no_rekening'];
        $pembiayaanM->total_pinjaman = $data['total_pinjaman'];
        $pembiayaanM->jumlah_angsuran = $data['jumlah_angsuran'];
        $pembiayaanM->sisa_angsuran = $data['sisa_angsuran'];
        $pembiayaanM->margin_keuntungan = $data['margin_keuntungan'];
        
        //OTOMATIS
        $sisa_cicilan2 = $data['jumlah_angsuran']*$data['margin_keuntungan']*$data['total_pinjaman']/100+$data['total_pinjaman'];
        $pembiayaanM->cicilan_perbulan = $sisa_cicilan2/$data['jumlah_angsuran'];
        $pembiayaanM->sisa_cicilan = $pembiayaanM->cicilan_perbulan*$data['sisa_angsuran'];
        $pembiayaanM->id_nasabah = $data['id_nasabah'];

        $pembiayaanM->save();
        return redirect()->back()->with('edit', 'data berhasil di delete');
    }

    public function managePembayaran()
    {
        $nasabahM = new Nasabah();
        $data['data'] = Pembayaran::with('pembiayaan', 'pembiayaan.nasabah.user')->get();
        $data['nasabah'] = $nasabahM->get();

        return view('admin.pembayaran', $data);
    }

    public function deletePembayaran($id, $id_pembiayaan)
    {
        $pembayaranM = Pembayaran::find($id);
        $pembayaranM->delete();

        $pembiayaanM = PembiayaanModel::find($id_pembiayaan);
        $pembiayaanM->sisa_angsuran = $pembiayaanM->sisa_angsuran+1;
        $pembiayaanM->sisa_cicilan = $pembiayaanM->sisa_cicilan+$pembiayaanM->cicilan_perbulan;
        $pembiayaanM->save();

        return redirect()->back()->with('delete', 'data berhasil di delete');
    }

    public function tambahPembayaran(Request $request)
    {
        $pembayaranM = new Pembayaran();
        $data =  $request->all();
        $pembayaranExist = Pembayaran::find($data['id_pembiayaan']);

        if($pembayaranExist == null){
            $count = 0;
        }
        else{
            $count = $pembayaranExist->count();
        }

        //UPDATE DI TABEL PEMBIAYAAN
        $pembiayaanM = PembiayaanModel::find($data['id_pembiayaan']);
        if($pembiayaanM == null)
        {
            return redirect()->back()->with('gagal', 'id tidak ditemukan');
        }
        $pembiayaanM->sisa_angsuran = $pembiayaanM->sisa_angsuran-1;
        $pembiayaanM->sisa_cicilan = $pembiayaanM->sisa_cicilan-$pembiayaanM->cicilan_perbulan;

        //TAMBAH DI TABEL PEMBAYARAN
        $pembayaranM->id_pembiayaan = $data['id_pembiayaan'];
        $pembayaranM->angsuran_ke = $count+1;
        $pembayaranM->nama_penyetor = $data['nama_penyetor'];
        $pembayaranM->angsuran_bulan = $data['angsuran_bulan'];
        $pembayaranM->total_bayar = $pembiayaanM->cicilan_perbulan;
        $pembayaranM->save();
        $pembiayaanM->save();
        
        return redirect()->back()->with('tambah', 'data berhasil di tambah');
    }

    public function editPembayaran(Request $request)
    {
        $data =  $request->all();

        $pembayaranM = Pembayaran::find($request->id_pembayaran);
        $lastdata = PembiayaanModel::find($pembayaranM->id_pembiayaan);
        $pembiayaanM = PembiayaanModel::find($request->id_pembiayaan);
        if($pembiayaanM == null)
        {
            return redirect()->back()->with('gagal', 'id tidak ditemukan');
        }
        else if($pembiayaanM != null && $pembayaranM->id_pembiayaan != $request->id_pembiayaan)
        {
            $pembiayaanM->sisa_angsuran = $pembiayaanM->sisa_angsuran-1;
            $pembiayaanM->sisa_cicilan = $pembiayaanM->sisa_cicilan-$pembiayaanM->cicilan_perbulan;
            $pembayaranM->total_bayar = $pembiayaanM->cicilan_perbulan;
            $lastdata->sisa_angsuran = $lastdata->sisa_angsuran+1;
            $lastdata->sisa_cicilan = $lastdata->sisa_cicilan+$lastdata->cicilan_perbulan;
            $lastdata->save();
        }
        $pembayaranM->id_pembiayaan = $data['id_pembiayaan'];
        $pembayaranM->nama_penyetor = $data['nama_penyetor'];
        $pembayaranM->angsuran_bulan = $data['angsuran_bulan'];
        $pembayaranM->save();
        $pembiayaanM->save();

        return redirect()->back()->with('edit', 'data berhasil di delete');
    }
}
