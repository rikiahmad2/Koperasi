<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Pembayaran;
use App\Models\PembiayaanModel;
use App\Models\User;
use Codedge\Fpdf\Fpdf\Fpdf;
use Throwable;
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

    public function viewPembayaran($id)
    {
        $this->fpdf = new Fpdf;
        $fpdf = $this->fpdf;
        $pembayaranM = Pembayaran::with('pembiayaan', 'pembiayaan.nasabah.user')->where('id_pembayaran', '=', $id)->first();

        header('Content-type: application/pdf');
        $fpdf->AddPage("L", 'A4');
        $fpdf->Image('assets/images/polos.jpg',0,0,297,210,'JPG');
        $fpdf->Image('assets/images/sisPastel.png',32,20,30,30,'PNG');
        $fpdf->Image('assets/images/ttd.png',110,115,70,70,'PNG');
        $fpdf->SetFont('Arial','B','14');
        
        $fpdf->Text(30, 55, "Inkopsyah BMT");
        $fpdf->SetFont('Arial','B','24');

        $fpdf->SetTextColor(87, 143, 102);
        $fpdf->Text(90, 35, "Bukti Pembayaran Angsuran");
        $fpdf->SetFont('Arial','B','16');
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Text(125, 45, "Inkopsyah BMT");
        $fpdf->SetFont('Arial','B','12');

        //SET LINE
        $fpdf->Text(130, 65, "Nama Nasabah :");
        $fpdf->SetLineWidth(0.8);
        $fpdf->Line(90, 85, 210-5, 85);
        $fpdf->setXY(90,75);
        $fpdf->SetFont('Arial','B','16');
        $fpdf->Cell(112,10,$pembayaranM->pembiayaan->nasabah->name,0,1,'C');
        
        //SEBAGAI PESERTA SIS
        $fpdf->SetFont('Arial','B','14');
        $fpdf->Text(97, 95, "Angsuran Bulan ".$pembayaranM->angsuran_bulan." (Angsuran ke- ".$pembayaranM->angsuran_ke.")");
        $fpdf->SetFont('Arial','','12');
        $fpdf->Text(100, 105, "Bukti Ini Dinyatakan Sah Sebagai Tanda Pembayaran");
        $fpdf->Text(112, 110, "Tanggal Bayar : ".$pembayaranM->created_at);
        $fpdf->Text(122, 115, "Jumlah Bayar : ".$pembayaranM->total_bayar);
        $fpdf->SetFont('Arial','B','16');
        $fpdf->setXY(168,113.5);
        $fpdf->SetTextColor(87, 143, 102);
        $fpdf->Text(123, 125, "Tanda Tangan :");

        $fpdf->SetFont('Arial','B','13');
        $fpdf->Text(120, 178, "Nurul Hakim Dwiyanti");
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Text(117, 184, "Founder Inkopsyah BMT");
        $this->fpdf->Output();
        exit;
    }

    public function laporanPembayaran(Request $request)
    {
        $id_pembiayaan = $request->input('id_pembiayaan');
        $data = Pembayaran::with('pembiayaan', 'pembiayaan.nasabah.user')->where('id_pembiayaan', '=', $id_pembiayaan)->get();
        if($data->count() == 0)
        {
            return redirect()->back()->with('gagal', 'id tidak ditemukan');
        }

        $this->fpdf = new Fpdf;
        $fpdf = $this->fpdf;

        header('Content-type: application/pdf');
        header('Content-type: application/pdf');
        $fpdf->AddPage("P", 'A4');

        //HEADER
        $fpdf->SetFont('Arial','B','10');
        $fpdf->Text(10, 15, "Kode Nasabah  :");
        $fpdf->Text(10, 20, "Nama Nasabah  :");
        $fpdf->Text(10, 25, "Kode Pembiayaan  :");
        $fpdf->Text(10, 30, "Sisa Cicilan  :");
        $fpdf->Text(10, 35, "Jumlah Angsuran  :");
        $fpdf->SetFont('Arial','','11');
        $fpdf->setY(11.5);
        $fpdf->setX(45);
        $fpdf->Cell(80,5,$data[0]->pembiayaan->nasabah->id_nasabah,0, 1, 'L');
        $fpdf->setY(16.5);
        $fpdf->setX(45);
        $fpdf->Cell(80,5,$data[0]->pembiayaan->nasabah->name,0, 1, 'L');
        $fpdf->setY(21.5);
        $fpdf->setX(45);
        $fpdf->Cell(80,5,$data[0]->pembiayaan->id_pembiayaan,0, 1, 'L');
        $fpdf->setY(26.5);
        $fpdf->setX(45);
        $fpdf->Cell(80,5,$data[0]->pembiayaan->sisa_cicilan,0, 1, 'L');
        $fpdf->setY(31.5);
        $fpdf->setX(45);
        $fpdf->Cell(80,5,$data[0]->pembiayaan->jumlah_angsuran,0, 1, 'L');

         // Membuat tabel
        $fpdf->Cell(10,17,'',0,1);
        $fpdf->SetFont('Arial','B',8);
        $fpdf->setX(30);
        $fpdf->Cell(10,6,'NO.',1,0, 'C');
        $fpdf->Cell(40,6,'Nama Penyetor',1,0, 'C');
        $fpdf->Cell(30,6,'Total Bayar',1,0, 'C');
        $fpdf->Cell(25,6,'Angsuran ke',1,0, 'C');
        $fpdf->Cell(50,6,'Tanggal Bayar',1,1, 'C');
        $fpdf->SetFont('Arial','',10);

        $i=1;
        foreach($data as $row){
            $fpdf->setX(30);
            $fpdf->Cell(10,20.5,$i.'.',1,0,'C');
            $fpdf->Cell(40,20.5,$row->nama_penyetor,1,0, 'C');
            $fpdf->Cell(30,20.5,$row->total_bayar,1,0 ,'C');
            $fpdf->Cell(25,20.5,$row->angsuran_ke,1,0, 'C');
            $fpdf->Cell(50,20.5,$row->created_at,1,1,'C');
            $i++;
        }

        $fpdf->SetTitle('Laporan Pembayaran '.$data[0]->pembiayaan->nasabah->name);
        $this->fpdf->Output();
        exit;
    }

    public function jurnalPembiayaan(Request $request)
    {
        $current_date = \Carbon\Carbon::now();
        $pembiayaanM = new PembiayaanModel();

        $data = $pembiayaanM->get();
        $data2 = Pembayaran::with('pembiayaan', 'pembiayaan.nasabah.user')->get();
        if($data->count() == 0)
        {
            return redirect()->back()->with('gagal', 'id tidak ditemukan');
        }

        $this->fpdf = new Fpdf;
        $fpdf = $this->fpdf;

        header('Content-type: application/pdf');
        header('Content-type: application/pdf');
        $fpdf->AddPage("P", 'A4');

        //HEADER
        $fpdf->SetFont('Arial','B','12');
        $fpdf->setY(21.5);
        $fpdf->setX(0);
        $fpdf->Cell(210,5,"DATA JURNAL INKOPSYIAH BMT",0, 1, 'C');
        $fpdf->SetFont('Arial','','11');
        $fpdf->setY(31.5);
        $fpdf->setX(0);
        $fpdf->Cell(210,5,"Laporan Data Jurnal Periode ".$data[0]->created_at.' - '.$current_date,0, 1, 'C');

         // Membuat tabel
        $fpdf->Cell(10,17,'',0,1);
        $fpdf->SetFont('Arial','B',8);
        $fpdf->setX(30);
        $fpdf->Cell(10,6,'NO.',1,0, 'C');
        $fpdf->Cell(40,6,'Tanggal',1,0, 'C');
        $fpdf->Cell(30,6,'Debit',1,0, 'C');
        $fpdf->Cell(25,6,'Kredit',1,0, 'C');
        $fpdf->Cell(50,6,'Keterangan',1,1, 'C');
        $fpdf->SetFont('Arial','',10);


        //TOTAL KREDIT
        $i=1;
        $total_kredit = 0;
        foreach($data as $row){
            $total_kredit += $row->total_pinjaman;
        }
        $fpdf->setX(30);
        $fpdf->Cell(10,20.5,$i.'.',1,0,'C');
        $fpdf->Cell(40,20.5,$data[0]->created_at,1,0, 'C');
        $fpdf->Cell(30,20.5,0,1,0 ,'C');
        $fpdf->Cell(25,20.5,$total_kredit,1,0, 'C');
        $fpdf->Cell(50,20.5,'Pembiayaan Mudharabah',1,1,'C');
        $i++;

        //DEBIT LIST
        $total_debit = 0;
        foreach($data2 as $row){
            $fpdf->setX(30);
            $fpdf->Cell(10,20.5,$i.'.',1,0,'C');
            $fpdf->Cell(40,20.5,$row->created_at,1,0, 'C');
            $fpdf->Cell(30,20.5,ceil($row->pembiayaan->total_pinjaman/$row->pembiayaan->jumlah_angsuran),1,0 ,'C');
            $fpdf->Cell(25,20.5,0,1,0, 'C');
            $fpdf->Cell(50,20.5,'Angsuran Mudharabah',1,1,'C');
            $i++;

            $total_debit += $row->pembiayaan->total_pinjaman/$row->pembiayaan->jumlah_angsuran; 
        }

        $sisa_kredit = $total_kredit - $total_debit;
        $fpdf->setX(30);
        $fpdf->Cell(10,20.5,$i.'.',1,0,'C');
        $fpdf->Cell(40,20.5,$current_date,1,0, 'C');
        $fpdf->Cell(30,20.5,0,1,0 ,'C');
        $fpdf->Cell(25,20.5,floor($sisa_kredit),1,0, 'C');
        $fpdf->Cell(50,20.5,'Sisa Pembiayaan Mudharabah',1,1,'C');
        $i++;

        $fpdf->SetTitle('Jurnal Pembiayaan');
        $this->fpdf->Output();
        exit;
    }
}
