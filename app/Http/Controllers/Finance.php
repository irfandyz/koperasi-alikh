<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Bank;
use App\Models\Detailshu;
use App\Models\Jenispinjaman;
use App\Models\JenisTransaksi;
use App\Models\KategoriTransaksi;
use App\Models\Peminjaman;
use App\Models\Pengajuan;
use App\Models\Pengambilan;
use App\Models\Shu;
use App\Models\Simpanan;
use App\Models\Tenor;
use App\Models\TransaksiPembayaran;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Finance extends Controller
{
    public function simpanananggota()
    {

        $record = Simpanan::where('status', '1')->paginate(15);
        $anggota = Anggota::get();
        $member = [];
        foreach ($anggota as $data) {
            array_push($member, $data->nama_anggota . " | " . $data->nip);
        }
        
        return view('admin/mod_finance/simpanan-anggota', compact('record', 'member'));
    }
    public function sim_simpanananggota(request $request)
    {
        
        // return $request;
        $anggota = Anggota::get();

        foreach ($anggota as $data) {
            if ($request->id_anggota == $data->nama_anggota . ' | ' . $data->nip) {
                $id = $data->id_anggota;
            }
        }

        // return $id;
        
        $simpanan = Simpanan::insert([
            'id_jenissimpanan' => $request->id_jenissimpanan,
            'id_anggota' => $id,
            'besar_simpanan' => $request->besar_simpanan,
            'id_users' => '1',
            'tgl_simpan' => $request->tgl_simpan,
            'status' => '1',
            'id_user' => Session::get('id'),
        ]);
        
        // if ($simpanan) {
        //     return "berhasil";
        // } else {
        //     return "salah";
        // }
        return redirect()->back();
    }
    public function hap_simpanananggota($id)
    {

        DB::delete("delete from tb_simpan where id_simpan ='$id' ");
        return redirect()->back();
    }
    public function ed_simpanananggota(request $request)
    {
        DB::update("update tb_simpan set
        id_jenissimpanan = '$request->id_jenissimpanan',
        id_anggota = '$request->id_anggota',
        besar_simpanan = '$request->besar_simpanan',
        tgl_simpan = '$request->tgl_simpan'
        where id_simpan = '$request->id'");
        return redirect()->back();
    }
    public function tabungananggota()
    {
        $anggota = Anggota::paginate(10);
        $pengambilan = Pengambilan::get();
        $transfer = Transfer::get();
        return view('admin/mod_finance/tabungan', compact( 'anggota', 'transfer', 'pengambilan'));
    }
    public function getRiwayat($id){
        $simpanan = Simpanan::where('id_anggota', $id)->where('status', '1')->get();
        $terima = Transfer::where('id_penerima', $id)->get();
        $kirim = Transfer::where('id_pengirim', $id)->get();
        $data = [];
        foreach ($simpanan as $value) {
            array_push($data,['tanggal'=>$value->tgl_simpan,'keterangan'=>'Anda Menyimpan Uang Sebesar Rp.'.number_format($value->besar_simpanan)]);
        }
        foreach ($terima as $value) {
            array_push($data,['tanggal'=>date('Y-m-d',strtotime($value->created_at)),'keterangan'=>'Anda Menerima Uang Sebesar Rp.'.number_format($value->besar_simpanan).' dari '.Anggota::find($id)->nama_anggota]);
        }
        foreach ($kirim as $value) {
            array_push($data,['tanggal'=>date('Y-m-d',strtotime($value->created_at)),'keterangan'=>'Anda Mengirim Uang Sebesar Rp.'.number_format($value->besar_simpanan).' kepada '.Anggota::find($id)->nama_anggota]);
        }
        function date_compare($element1, $element2) {
            $datetime1 = strtotime($element1['tanggal']);
            $datetime2 = strtotime($element2['tanggal']);
            return $datetime1 - $datetime2;
        } 
        usort($data, 'date_compare');
        return response()->json([
            'data'=>$data
        ], 200); 
    }
    public function sim_tabungananggota(request $request)
    {

        DB::update("insert into tb_tabungan(id_anggota, besar_tabungan,  id_users, tgl_tabungan )
        values ('$request->id_anggota','$request->besar_tabungan','1','$request->tgl_tabungan') ");

        return redirect()->back();
    }
    public function hap_tabungananggota($id)
    {

        DB::delete("delete from tb_tabungan where id_tabungan ='$id' ");
        return redirect()->back();
    }
    public function ed_tabungananggota(request $request)
    {
        DB::update("update tb_tabungan set
        id_anggota = '$request->id_anggota',
        besar_tabungan = '$request->besar_tabungan',
        tgl_tabungan = '$request->tgl_tabungan'
         where id_tabungan = '$request->id'");
        return redirect()->back();
    }
    public function pengajuan()
    {
        $record = Pengajuan::with('tenor')->get();
        $pinjaman = Jenispinjaman::get();
        $member = [];
        $anggota = Anggota::get();

        foreach ($anggota as $data) {
            array_push($member, $data->nama_anggota . " | " . $data->nik);
        }
        // return $member;
        // return $record;
        return view('admin/mod_finance/pengajuan', compact('record', 'pinjaman', 'member'));
    }
    public function sim_pengajuan(request $request)
    {

        DB::update("insert into tb_pengajuan(id_jenispinjaman, id_anggota, besar_pinjam,  id_users, tgl_pengajuan )
        values ('$request->id_jenispinjaman', '$request->id_anggota','$request->besar_pinjam','1','$request->tgl_pengajuan') ");

        return redirect()->back();
    }
    public function hap_pengajuan($id)
    {

        DB::delete("delete from tb_pengajuan where id_pengajuan ='$id' ");
        return redirect()->back();
    }
    public function ed_pengajuan(request $request)
    {
        DB::update("update tb_pengajuan set
        id_jenispinjaman = '$request->id_jenispinjaman',
        id_anggota = '$request->id_anggota',
        besar_pinjam = '$request->besar_pinjam',
        tgl_pengajuan = '$request->tgl_pengajuan'
         where id_pengajuan = '$request->id'");
        return redirect()->back();
    }
    public function pengambilan()
    {

        $record = Pengambilan::with('jenispengambilan')->get();
        return view('admin/mod_finance/pengambilan', compact('record'));
    }
    public function sim_pengambilan(request $request)
    {

        DB::update("insert into tb_pengambilan(id_anggota, besar_ambil,  id_users, tgl_pengambilan,id_jenispengambilan )
        values ('$request->id_anggota','$request->besar_ambil','1','$request->tgl_pengambilan','3') ");

        return redirect()->back();
    }
    public function hap_pengambilan($id)
    {

        DB::delete("delete from tb_pengambilan where id_pengambilan ='$id' ");
        return redirect()->back();
    }
    public function ed_pengambilan(request $request)
    {
        DB::update("update tb_pengambilan set
        id_anggota = '$request->id_anggota',
        besar_ambil = '$request->besar_ambil',
        tgl_pengambilan = '$request->tgl_pengambilan'
         where id_pengambilan = '$request->id'");
        return redirect()->back();
    }
    public function konfirmasi_tabungan()
    {
        $tabungan = Simpanan::where('status', '0')->orWhere('status', null)->get();
        return view('admin/mod_finance/konfirmasi', compact('tabungan'));
    }
    public function konfirmasi($id)
    {
        $simpanan = Simpanan::find($id);
        $simpanan->status = '1';
        $simpanan->timestamps = false;
        $simpanan->save();
        return redirect()->back();
    }
    public function transfer()
    {
        $transfer = Transfer::get();
        $anggota = Anggota::get();
        return view('admin/mod_finance/transfer', compact('transfer', 'anggota'));
    }
    public function konfirmasi_pengajuan($id)
    {
        $peminjaman = [];
        // $pengajuan = Pengajuan::join('tb_tenor', 'tb_tenor.id_tenor', '=', 'tb_pengajuan.id_tenor')->join('tb_jenispinjaman', 'tb_jenispinjaman.id_jenispinjaman', '=', 'tb_tenor.id_jenispinjaman')->where('id_pengajuan', $id)->first();
        // $bunga = ($pengajuan->besar_pinjam * ($pengajuan->bunga / 100));
        // $lama = round($pengajuan->besar_pinjam / $pengajuan->lama_tenor);
        // $total = $bunga + $lama;
        // for ($i = 1; $i <= $pengajuan->lama_tenor; $i++) {
        //     $peminjaman[] = [
        //         "id_pengajuan" => $id,
        //         "jumlah" => $total,
        //         "status" => "N",
        //     ];
        // }
        // Peminjaman::insert($peminjaman);
        Pengajuan::where('id_pengajuan', $id)->update(['status' => '1', 'id_users' => Session::get('id')]);
        return redirect()->back();
    }
    public function shu()
    {
        $shu = Shu::get();
        $detail = Detailshu::get();
        return view('admin.mod_finance.shu', compact('shu', 'detail'));
    }
    public function tambah_shu(request $request)
    {
        Shu::insert([
            'tahun' => $request->tahun,
            'total_shu' => $request->total,
        ]);
        return redirect()->back();
    }
    public function tambah_detailshu(request $request)
    {
        for ($i = 0; $i < count($request->nama); $i++) {
            Detailshu::insert([
                'id_shu' => $request->id,
                'nama_variabel' => $request->nama[$i],
                'prosentasi' => $request->persentasi[$i],
            ]);
        }
        return redirect()->back();
    }
    public function hapus_detailshu($id)
    {
        Detailshu::where('id_detailshu', $id)->delete();
        return redirect()->back();
    }

    public function transaksi_keuangan()
    {
        $bank = Bank::orderBy("nama_bank", "ASC")->get();
        $jenistransaksi = JenisTransaksi::orderBy("nama_jenis_transaksi", "ASC")->get();
        $transaksi = TransaksiPembayaran::leftjoin('kategori_transaksi', 'kategori_transaksi.id_kategori_transaksi', '=', 'transaksi.id_kategori_transaksi')->leftjoin('jenistransaksi', 'jenistransaksi.id_jenis_transaksi', '=', 'kategori_transaksi.id_jenis_transaksi')->leftjoin('bank', 'bank.id_bank', '=', 'transaksi.id_bank')->orderBy("created_at", "ASC")->get();

        return view('admin.mod_finance.transaksi-keuangan', compact('bank', 'jenistransaksi', 'transaksi'));
    }

    public function requestTransaksi(request $request)
    {
        $kategori = KategoriTransaksi::where('id_jenis_transaksi', $request->id_jenis_transaksi)->orderBy('nama_kategori', 'ASC')->get();

        return response()->json(['kategori' => $kategori], 200);
    }

    public function tambahTransaksi(request $request)
    {
        $data = [
            "kode_transaksi" => "TR" . rand(0000000, 9999999),
            "id_kategori_transaksi" => $request->id_kategori_transaksi,
            "nominal" => $request->nominal,
            "keterangan" => $request->keterangan,
            "id_bank" => $request->id_bank,
            "id_user" => Session::get('id'),
        ];

        $query = TransaksiPembayaran::insert($data);

        if ($query) {
            return redirect()->back()->with('message', 'Berhasil');
        } else {
            return redirect()->back()->with('message', 'Gagal');
        }
    }

    public function requestTenor(request $request)
    {
        $tenor = Tenor::where('id_jenispinjaman', $request->id_jenis_pinjaman)->get();

        return response()->json(['tenor' => $tenor], 200);
    }

    public function addPeminjaman(request $request)
    {
        $kode_pengajuan = rand(0000, 9999) . $request->id_anggota . $request->besar_pinjaman;
        $anggota = Anggota::get();
        foreach ($anggota as $data) {
            if ($request->nama == $data->nama_anggota . " | " . $data->nik) {
                $array = [
                    "tgl_pengajuan" => date("Y-m-d"),
                    "id_anggota" => $data->id_anggota,
                    "id_tenor" => $request->id_tenor,
                    "besar_pinjam" => $request->besar_pinjaman,
                    "id_users" => 1,
                    "status" => 1,
                    "kode_pengajuan" => $kode_pengajuan,
                ];
                $check = Pengajuan::insert($array);

                // if (isset($check)) {
                //     $peminjaman = [];
                //     $pengajuan = Pengajuan::join('tb_tenor', 'tb_tenor.id_tenor', '=', 'tb_pengajuan.id_tenor')->join('tb_jenispinjaman', 'tb_jenispinjaman.id_jenispinjaman', '=', 'tb_tenor.id_jenispinjaman')->where('kode_pengajuan', $kode_pengajuan)->first();
                //     $bunga = ($pengajuan->besar_pinjam * ($pengajuan->bunga / 100));
                //     $lama = round($pengajuan->besar_pinjam / $pengajuan->lama_tenor);
                //     $total = $bunga + $lama;
                //     for ($i = 1; $i <= $pengajuan->lama_tenor; $i++) {
                //         $peminjaman[] = [
                //             "id_pengajuan" => $pengajuan->id_pengajuan,
                //             "jumlah" => $total,
                //             "status" => "N",
                //         ];
                //     }
                //     Peminjaman::insert($peminjaman);
                // }
                return redirect()->back();
            }
        }
    }

    public function updateStatus($id)
    {
        Peminjaman::where('id_peminjaman', $id)->update([
            "status" => "Y",
        ]);

        return redirect()->back();
    }
    public function printKeuangan($id)
    {
        $transaksi = TransaksiPembayaran::find($id);
        return view('admin.mod_finance.printKeuangan', compact('transaksi'));
    }
    
    public function addBankNominal($id) {
        $bank = Bank::get();
        $record = Peminjaman::where('id_peminjaman',$id)->first();
        
        return view('admin.mod_finance.tambah-nominal-bank',compact('record','bank'));
    }
    
    public function tambahNominalBank(request $request) {
        // return $request;
        $peminjaman = Peminjaman::where('id_peminjaman',$request->id_peminjaman)->first();
        $pengajuan = Pengajuan::where('id_pengajuan',$peminjaman->id_pengajuan)->first();
        $anggota = Anggota::where('id_anggota',$pengajuan->id_anggota)->first();
        $zakatProfesi = $anggota->gaji_bersih * 0.025;
        $totalRow = Peminjaman::where('id_pengajuan', $peminjaman->id_pengajuan)->count();
        
        if ($totalRow >= 10 && $totalRow <= 20) {
            $admin = round(($peminjaman->pokok + $peminjaman->jasa) * 0.015);
        } else if ($totalRow > 20) {
            $admin = round(($peminjaman->pokok + $peminjaman->jasa) * 0.02);   
        } else {
            $admin = round(($peminjaman->pokok + $peminjaman->jasa) * 0.01);
        }
        
        $totalPeminjaman = $peminjaman->jasa + $peminjaman->pokok + $admin + $request->jumlah + $request->barang + $request->pokja;
        
        Peminjaman::where('id_peminjaman',$request->id_peminjaman)->update([
            "jumlah" => $request->jumlah,
            "id_bank" => $request->id_bank,
            "barang" => $request->barang,
            "zakat_profesi" => round($zakatProfesi),
            "pokja" => $request->pokja,
            "status" => "Y"
        ]);
        
        return redirect()->to('pengajuan-anggota');
    }
    
    public function detailPeminjaman($id) {
        $peminjaman = Peminjaman::join('bank','bank.id_bank','=','tb_peminjaman.id_bank')->where('id_peminjaman',$id)->first();
        $totalRow = Peminjaman::where('id_pengajuan', $peminjaman->id_pengajuan)->count();
        $pengajuan = Pengajuan::where('id_pengajuan',$peminjaman->id_pengajuan)->first();
        $anggota = Anggota::where('id_anggota',$pengajuan->id_anggota)->first();
        
        if ($totalRow >= 10 && $totalRow <= 20) {
            $admin = round(($peminjaman->pokok + $peminjaman->jasa) * 0.015);
        } else if ($totalRow > 20) {
            $admin = round(($peminjaman->pokok + $peminjaman->jasa) * 0.02);   
        } else {
            $admin = round(($peminjaman->pokok + $peminjaman->jasa) * 0.01);
        }
        // return $peminjaman;
        return view('admin.mod_finance.detailPeminjaman',compact('peminjaman','admin','anggota'));
    } 
    
    public function tenorPinjaman() {
        $tenor = Tenor::leftjoin('tb_jenispinjaman','tb_jenispinjaman.id_jenispinjaman','=','tb_tenor.id_jenispinjaman')->get();
        
        $jenispinjaman = Jenispinjaman::get();
        // return $tenor;
        
        return view('admin.mod_finance.tenor-pinjaman', compact('tenor','jenispinjaman'));
    }
    
    public function tambahTenorPinjaman(request $request) {
        Tenor::insert([
            "lama_tenor"=>$request->lama_tenor,
            "id_jenispinjaman"=>$request->id_jenispinjaman,
        ]);
        
        return redirect()->back();
    }
    
    public function hapusTenorPinjaman($id) {
        Tenor::where('id_tenor',$id)->delete();
        
        return redirect()->back();
    }
    
    public function updateTenorPinjaman(request $request) {
        Tenor::where('id_tenor',$request->id_tenor)->update([
            "lama_tenor"=>$request->lama_tenor,
            "id_jenispinjaman"=>$request->id_jenispinjaman,
        ]);
        
        return redirect()->back();
    }
    public function searchAnggota($keyword){
        $value = Anggota::where('nama_anggota','LIKE',"%$keyword%")->take(10)->get();
        return response()->json([
            'anggota'=>$value
        ], 200);
    }
}
