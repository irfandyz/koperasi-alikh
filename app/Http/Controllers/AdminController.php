<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\JenisTransaksi;
use App\Models\KategoriTransaksi;
use App\Models\Pengambilan;
use App\Models\Simpanan;
use App\Models\TransaksiPembayaran;
use App\Models\Transfer;
use App\Models\Pengajuan;
use App\Models\Peminjaman;
use App\Models\Users;
use App\Models\Menu;
use App\Models\Online;
use App\Models\Submenu;
use App\Models\Notif;
use App\Models\Tag;
use App\Models\Pendis;
use App\Models\Bimnas;
use App\Models\Sementara;
use App\Models\Langsung;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $anggota = Anggota::get();
        $keluar = KategoriTransaksi::select('id_kategori_transaksi')->where('id_jenis_transaksi', '2')->get();
        $masuk = KategoriTransaksi::select('id_kategori_transaksi')->where('id_jenis_transaksi', '1')->get();
        $transaksi = TransaksiPembayaran::get();
        $arrmsk = [];
        $arrklr = [];
        foreach ($masuk as $msk) {
            array_push($arrmsk, $msk->id_kategori_transaksi);
        }
        foreach ($keluar as $klr) {
            array_push($arrklr, $klr->id_kategori_transaksi);
        }
        $debit = $transaksi->whereIn('id_kategori_transaksi', $arrklr);
        $kredit = $transaksi->whereIn('id_kategori_transaksi', $arrmsk);
        return view('admin.home', compact('transaksi', 'anggota', 'kredit', 'debit'));
    }
    public function dataUser()
    {
        $user = Users::get();
        $tag = Tag::get();
        $menu = Menu::get();
        $submenu = Submenu::get();
        return view('admin.mod_master.dataUser', compact('user', 'tag', 'menu', 'submenu'));
    }
    public function addUser(request $request)
    {
        $foto = $request->foto;
        $rename = date('dmYHis') . "." . $foto->extension();
        $foto->move('userImage', $rename);
        Users::insert([
            'username' => $request->username,
            'password' => bcrypt($request->pasword),
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telp' => $request->telepon,
            'foto' => $rename,
            'level' => $request->level,
            'blokir' => 'N',
            'menu_id' => json_encode($request->menu_id) ?? null,
            'submenu_id' => json_encode($request->submenu_id),
        ]);
        return redirect()->back();
    }
    public function grafikTransaksi()
    {
        $anggota = Anggota::get();
        $keluar = KategoriTransaksi::select('id_kategori_transaksi')->where('id_jenis_transaksi', '2')->get();
        $masuk = KategoriTransaksi::select('id_kategori_transaksi')->where('id_jenis_transaksi', '1')->get();
        $transaksi = TransaksiPembayaran::get();
        $arrmsk = [];
        $arrklr = [];
        foreach ($masuk as $msk) {
            array_push($arrmsk, $msk->id_kategori_transaksi);
        }
        foreach ($keluar as $klr) {
            array_push($arrklr, $klr->id_kategori_transaksi);
        }
        $debit = $transaksi->whereIn('id_kategori_transaksi', $arrklr);
        $kredit = $transaksi->whereIn('id_kategori_transaksi', $arrmsk);
        $pemasukan = number_format($kredit->sum('nominal'));
        $pengeluaran = number_format($debit->sum('nominal'));
        $arrayNom = [];

        array_push($arrayNom, intval(preg_replace('/[^\d. ]/', '', $pengeluaran)));
        array_push($arrayNom, intval(preg_replace('/[^\d. ]/', '', $pemasukan)));
        return view('admin.grafikTransaksi', compact('arrayNom'));

    }
    public function laporanTransaksi(request $request)
    {
        if ($request->type == 'laporanUmum') {
            $type = 'JURNAL UMUM';
            $transaksi = TransaksiPembayaran::whereBetween('created_at', [$request->TanggalAwal, $request->TanggalAkhir])->get();
            $debit = 0;
            $kredit = 0;
            foreach ($transaksi as $data) {
                if ($data->kategori->id_jenis_transaksi == '2') {
                    $debit = $debit + $data->nominal;
                } else {
                    $kredit = $kredit + $data->nominal;
                }
            }
            return view('admin.mod_finance.laporanTransaksi', compact('transaksi', 'kredit', 'debit', 'request', 'type'));
        }
        if ($request->type == 'laporanBesar') {
            $type = 'BUKU BESAR';
            $kategori = KategoriTransaksi::get();
            $transaksi = TransaksiPembayaran::whereBetween('created_at', [$request->TanggalAwal, $request->TanggalAkhir])->get();
            return view('admin.mod_finance.laporanTransaksi', compact('transaksi', 'request', 'type', 'kategori'));
        }
        if ($request->type == 'laporanNeraca') {
            $type = 'NERACA SALDO';
            $kategori = KategoriTransaksi::get();
            $transaksi = TransaksiPembayaran::whereBetween('created_at', [$request->TanggalAwal, $request->TanggalAkhir])->get();
            return view('admin.mod_finance.laporanTransaksi', compact('transaksi', 'request', 'type', 'kategori'));
        }
        if ($request->type == 'laporanIncome') {
            $type = 'INCOME STATEMENT';
            $jenis = JenisTransaksi::get();
            $kategori = KategoriTransaksi::get();
            $transaksi = TransaksiPembayaran::whereBetween('created_at', [$request->TanggalAwal, $request->TanggalAkhir])->get();
            return view('admin.mod_finance.laporanTransaksi', compact('transaksi', 'request', 'type', 'kategori', 'jenis'));
        }

    }
    public function laporanSimpanan(request $request)
    {
        $simpan = Simpanan::whereBetween('created_up', [$request->TanggalAwal, $request->TanggalAkhir])->get();
        $awal = $request->TanggalAwal;
        $akhir = $request->TanggalAkhir;
        return view('admin.mod_finance.laporanSimpanan', compact('simpan', 'awal', 'akhir'));

    }
    public function laporanTabungan()
    {
        $anggota = Anggota::get();
        $record = Simpanan::get();
        $pengambilan = Pengambilan::get();
        $transfer = Transfer::get();

        return view('admin/mod_finance/laporanTabungan', compact('record', 'anggota', 'transfer', 'pengambilan'));
    }
    public function userOnline()
    {
        $online = Online::get();
        return view('admin.mod_master.userOnline', compact('online'));
    }
    
    public function terimaPeminjaman() {
        $record = Pengajuan::where('status',1)->get();
        return view('admin.mod_finance.terima-peminjaman',compact('record'));
    }
    
    public function updateStatusPengajuan($id) {
        Pengajuan::where('id_pengajuan',$id)->update([
            "status"=>"2",    
        ]);
        
        $pengajuan = Pengajuan::join('tb_tenor', 'tb_tenor.id_tenor', '=', 'tb_pengajuan.id_tenor')->join('tb_jenispinjaman', 'tb_jenispinjaman.id_jenispinjaman', '=', 'tb_tenor.id_jenispinjaman')->where('id_pengajuan', $id)->first();
        $bunga = ($pengajuan->besar_pinjam * ($pengajuan->bunga / 100));
        $lama = round($pengajuan->besar_pinjam / $pengajuan->lama_tenor);
        $total = $bunga + $lama;
        $start = $month = strtotime(date('Y-m-d'));
        $end = strtotime(date("Y-m-d",strtotime("+$pengajuan->lama_tenor month")));
        while($month < $end)
        {
            $peminjaman[] = [
                "id_pengajuan" => $id,
                "jasa" => $bunga,
                "pokok" => $lama,
                "status" => "N",
                "periode" => date("F Y",$month)
            ]; 
            $month = strtotime("+1 month", $month);
        }
        
        // return $peminjaman;
        Peminjaman::insert($peminjaman);
        
        Notif::insert([
            "id_anggota" => $pengajuan->id_anggota,
            "keterangan" => "Pengajuan anda telah kami terima dan telah kami verifikasi"
        ]);
        
        return redirect()->back();
    }
    public function pinjaman_pendis(){
        $result = Pendis::get();
        $anggota = Anggota::get();
        return view('admin.pinjaman.pinjaman_pendis',compact('result','anggota'));
    }
    public function pinjaman_bimnas(){
        $result = Bimnas::get();
        $anggota = Anggota::get();
        return view('admin.pinjaman.pinjaman_bimnas',compact('result','anggota'));
    }
    public function pinjaman_sementara(){
        $result = Sementara::get();
        $anggota = Anggota::get();
        return view('admin.pinjaman.pinjaman_sementara',compact('result','anggota'));
    }
    public function pinjaman_langsung(){
        $result = Langsung::get();
        $anggota = Anggota::get();
        return view('admin.pinjaman.pinjaman_langsung',compact('result','anggota'));
    }
    public function searchAnggota(request $request)
    {
        $keyword = $request->key;
        if ($keyword == '') {
            $data = [];
        }else{
            $data = Anggota::where('nama_anggota', 'LIKE', '%'.$keyword.'%')->take(10)->get();
        }
        return response()->json($data,200);
    }
    public function tambahSementara(request $request){
        $anggota = Anggota::where('nip',$request->nip)->first();
        Sementara::create([
            'id_anggota'=>$anggota->id_anggota,
            'nip'=>$request->nip,
            'no_kas'=>$request->no_kas,
            'tgl_mulai'=>$request->tgl_mulai,
            'besar_pinjaman'=>$request->besar_pinjaman,
            'besar_pembayaran'=>$request->besar_pembayaran,
            'keterangan'=>$request->keterangan,
        ]);
        return redirect()->back();
    }
    public function tambahPendis(request $request){
        $anggota = Anggota::where('nip',$request->nip)->first();
        Pendis::create([
            'id_anggota'=>$anggota->id_anggota,
            'nip'=>$request->nip,
            'pokok_jasa'=>$request->pokok_jasa,
            'no_kas'=>$request->no_kas,
            'tgl_mulai'=>$request->tgl_mulai,
            'tgl_selesai'=>$request->tgl_selesai,
            'tenor'=>$request->tenor,
        ]);
        return redirect()->back();
    }
    public function tambahBimnas(request $request){
        $anggota = Anggota::where('nip',$request->nip)->first();
        Bimnas::create([
            'id_anggota'=>$anggota->id_anggota,
            'nip'=>$request->nip,
            'pokok_jasa'=>$request->pokok_jasa,
            'no_kas'=>$request->no_kas,
            'tgl_mulai'=>$request->tgl_mulai,
            'tgl_selesai'=>$request->tgl_selesai,
            'tenor'=>$request->tenor,
        ]);
        return redirect()->back();
    }
    public function tambahLangsung(request $request){
        $anggota = Anggota::where('nip',$request->nip)->first();
        Langsung::create([
            'id_anggota'=>$anggota->id_anggota,
            'nip'=>$request->nip,
            'pokok_jasa'=>$request->pokok_jasa,
            'no_kas'=>$request->no_kas,
            'tgl_mulai'=>$request->tgl_mulai,
            'tgl_selesai'=>$request->tgl_selesai,
            'tenor'=>$request->tenor,
            'simpanan_wajib'=>$request->simpanan_wajib,
            'shr'=>$request->shr,
        ]);
        return redirect()->back();
    }
}
