<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Kategori;
use App\Models\Kartukop;
use App\Models\Pengajuan;
use App\Models\Pengguna;
use App\Models\Anggota;
use App\Models\Jenispinjaman;
use App\Models\Information;
use App\Models\Jenissimpanan;
use App\Models\Simpanan;
use App\Models\Jenispengambilan;
use App\Models\Pengambilan;
use App\Models\Tabungan;
use App\Models\Mitra;
use App\Models\Tenor;
use App\Models\Transfer;
use App\Models\Banner;
use App\Models\Users;
use App\Models\Peminjaman;
use App\Models\Notif;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CooperativeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $statusCode = 200;

    public function getKategori()
    {
        $query = Kategori::get();

        $response = [
            "message" => "success",
            "Kategori" => $query,
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getBank()
    {
        $query = Bank::get();

        $response = [
            "message" => "success",
            "Bank" =>  $query
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getMitra()
    {
        $query = Mitra::get();

        $response = [
            "message" => "success",
            "Mitra" => $query
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getJumlahAnggota()
    {
        $query = Anggota::count();

        $response = [
            "jumlah" => $query,
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getJenisPinjaman()
    {
        $query = Jenispinjaman::get();

        $response = [
            "jenpin" => $query
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getJenisSimpanan()
    {
        $query = Jenissimpanan::get();

        $response = [
            "jensim" => $query
        ];

        return response()->json($response, $this->statusCode);
    }
    public function simpan_pengajuan(request $request)
    {
        Pengajuan::insert([
            'tgl_pengajuan' => date('Y-m-d'),
            'id_anggota' => $request->id_anggota,
            'id_tenor' => $request->id_tenor,
            'besar_pinjam' => $request->besar_pinjam,
            'id_users' => 1,
            'status' => 0,
        ]);
        return response()->json([
            'status' => 'success'
        ], $this->statusCode);
    }

    public function getInformation(request $request)
    {
        $query = Information::get();
        $response = [
            'information' => $query,
        ];
        return response()->json($response, $this->statusCode);
    }

    public function addSimpanan(request $request)
    {
        $imageName = time() . '.' . $request->foto->extension();

        Simpanan::insert([
            'id_jenissimpanan' => $request->id_jenissimpanan,
            'besar_simpanan' => $request->besar_simpanan,
            'id_anggota' => $request->id_anggota,
            'id_users' => 1,
            'tgl_simpan' => date('Y-m-d'),
            'foto' => $imageName,
            'status' => 0,
            'created_up' => date('Y-m-d'),
        ]);

        $request->foto->move('foto_simpanan', $imageName);

        return response()->json(['message' => 'berhasil'], $this->statusCode);
    }

    public function getTenor($id)
    {
        $query = Tenor::where('id_jenispinjaman', $id)->get();

        if ($query) {
            return response()->json(['message' => 'Berhasil', 'tenor' => $query], $this->statusCode);
        } else {
            return response()->json(['message' => 'error'], $this->statusCode);
        }
    }

    public function getPengajuan($id)
    {
        $query = Pengajuan::join('tb_tenor', 'tb_tenor.id_tenor', '=', 'tb_pengajuan.id_tenor')->join('tb_jenispinjaman', 'tb_jenispinjaman.id_jenispinjaman', '=', 'tb_tenor.id_jenispinjaman')->select('tb_tenor.id_tenor', 'tb_jenispinjaman.nama_pinjaman', 'tb_pengajuan.besar_pinjam', 'tb_pengajuan.create_up', 'tb_tenor.lama_tenor', 'tb_pengajuan.status', 'tb_jenispinjaman.bunga')->where('id_anggota', $id)->orderBy('tb_pengajuan.id_pengajuan', 'DESC')->get();

        $response = [
            'message' => 'success',
            'pengajuan' => $query,
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getJumlahAdmin()
    {
        $query = Users::count();

        $response = [
            'users' => $query
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getSimpan($id)
    {
        $query = Simpanan::join('tb_jenissimpanan', 'tb_jenissimpanan.id_jenissimpanan', '=', 'tb_simpan.id_jenissimpanan')->select('tb_simpan.besar_simpanan', 'tb_jenissimpanan.nama_simpanan', 'tb_simpan.id_anggota', 'tb_simpan.id_simpan', 'tb_simpan.tgl_simpan', 'tb_simpan.id_jenissimpanan')->where('id_anggota', $id)->get();

        $response = [
            'simpanan' => $query
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getSimpanan()
    {
        $query = Simpanan::get();

        $response = [
            'simpanan' => $query
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getTabungan($id)
    {
        $record = Simpanan::get();
        $transfer = Transfer::get();
        $pengambilan = Pengambilan::get();
        $saldo = $record->where('id_anggota', $id)->whereNotIn('id_jenissimpanan', ['1', '4'])->where('status', '1')->sum('besar_simpanan') +
            $transfer->where('id_penerima', $id)->sum('jumlah') -
            $transfer->where('id_pengirim', $id)->sum('jumlah') -
            $pengambilan->where('id_anggota', $id)->sum('besar_ambil');

        return response()->json(['saldo' => $saldo], $this->statusCode);
    }

    public function getHistory($id, request $request)
    {
        $query = Simpanan::where('tb_simpan.id_anggota', $id)->whereBetween('created_up', [$request->dari, $request->hingga])->get();
        $query2 = Pengambilan::where('id_anggota', $id)->whereBetween('tgl_pengambilan', [$request->dari, $request->hingga])->get();

        $response = [
            'simpanan' => $query,
            'pengambilan' => $query2,
        ];
        return response()->json($response, $this->statusCode);
    }

    public function addPengambilan(request $request)
    {
        $kartukop = Kartukop::where('nomor_kartu', $request->nomor_kartu)->first();
        // return $kartukop;
        $record = Simpanan::get();
        $transfer = Transfer::get();
        $saldo = $record->where('id_anggota', $request->id_pengirim)->whereNotIn('id_jenissimpanan', ['1', '4'])->where('status', '1')->sum('besar_simpanan') +
            $transfer->where('id_penerima', $request->id_pengirim)->sum('jumlah') -
            $transfer->where('id_pengirim', $request->id_pengirim)->sum('jumlah');
        $total = $saldo - $request->jumlah;

        if ($total < 10000) {
            return response()->json(['message' => 'Saldo anda kurang'], $this->statusCode);
        } else {
            Transfer::insert([
                "kode_transfer" => "TRX" . rand(10000000, 99999999),
                "jumlah" => $request->jumlah,
                "id_pengirim" => $request->id_pengirim,
                "id_penerima" => $kartukop->id_anggota,
            ]);
            return response()->json(["message" => "Berhasil"], $this->statusCode);
        }
    }

    public function getTransaksi($id)
    {
        // $query = Transfer::where('id_pengirim',$id)->get();
        // $query2 = Transfer::where("id_penerima",$id)->get();
        // $response = [
        //     "message"=>"berhasil",
        //     "transaksi"=>$query,
        //     "diterima"=>$query2,
        // ];

        // return response()->json($response,$this->statusCode);
        $query = Transfer::where("id_pengirim", $id)->orWhere("id_penerima", $id)->get();

        return response()->json(['diterima' => $query], $this->statusCode);
    }

    public function getPinjamanNotification($id)
    {
        $query = Pengajuan::where('id_anggota', $id)->get();

        $response = [
            "pinjaman" => $query
        ];

        return response()->json($response, $this->statusCode);
    }

    public function getBanner()
    {
        $banner = Banner::where('aktif', 'Y')->orderBy('id_banner', 'ASC')->get();

        $response = [
            "banner" => $banner,
        ];

        return response()->json($response, $this->statusCode);
    }
    
    public function getLoanConf() {
        $pengajuan = Pengajuan::with('anggota')->where('status','1')->get();
        
        return response()->json(['pengajuan'=>$pengajuan],$this->statusCode);
    }
    
    public function updateStatusLoan($id) {
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
        $cek = Peminjaman::insert($peminjaman);
        
        if ($cek){
             Notif::insert([
                "id_anggota" => $pengajuan->id_anggota,
                "keterangan" => "Pengajuan anda telah kami terima dan telah kami verifikasi"
            ]);
            
            return response()->json(['message'=>1],$this->statusCode);
        } else {
            return response()->json(['message'=>0],$this->statusCode);
        }
    }
}
