<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Bank;
use App\Models\Information;
use App\Models\Jenissimpanan;
use App\Models\JenisTransaksi;
use App\Models\KategoriTransaksi;
use App\Models\Simpanan;
use App\Imports\ImportAnggota;
use App\Imports\ImportPeminjaman;
use App\Imports\ImportSimpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class App extends Controller
{
    public function jenispinjaman()
    {

        $record = DB::select('select * from tb_jenispinjaman');

        return view('admin.mod_master/jenis-pinjaman', compact('record'));
    }
    public function sim_jenispinjaman(request $request)
    {
        $tgl_input = date('Y-m-d');
        DB::update("insert into tb_jenispinjaman(nama_pinjaman, lama_angsuran, maks_pinjam, bunga, id_users, tgl_entri )
        values ('$request->nama_pinjaman', '$request->lama_angsuran','$request->maksimal_pinjaman','$request->bunga','1','$tgl_input') ");

        return redirect()->back();
    }
    public function hap_jenispinjaman($id)
    {

        DB::delete("delete from tb_jenispinjaman where id_jenispinjaman ='$id' ");
        return redirect()->back();
    }
    public function ed_jenispinjaman(request $request)
    {
        DB::update("update tb_jenispinjaman set
        nama_pinjaman = '$request->nama_pinjaman',
        lama_angsuran = '$request->lama_angsuran',
        maks_pinjam = '$request->maksimal_pinjaman',
        bunga = '$request->bunga'
         where id_jenispinjaman = '$request->id'");
        return redirect()->back();
    }
    public function jenissimpanan()
    {

        $record = DB::select('select * from tb_jenissimpanan');
        // return "OKeh";
        return view('admin.mod_master/jenis-simpanan', compact('record'));
    }
    public function sim_jenissimpanan(request $request)
    {
        $tgl_input = date('Y-m-d');
        DB::update("insert into tb_jenissimpanan(nama_simpanan, besar_simpanan, id_users, tgl_entri )
        values ('$request->nama_simpanan', '$request->besar_simpanan','1','$tgl_input') ");

        return redirect()->back();
    }
    public function hap_jenissimpanan($id)
    {

        DB::delete("delete from tb_jenissimpanan where id_jenissimpanan ='$id' ");
        return redirect()->back();
    }
    public function ed_jenissimpanan(request $request)
    {
        DB::update("update tb_jenissimpanan set
        nama_simpanan = '$request->nama_simpanan',
        besar_simpanan = '$request->besar_simpanan'
         where id_jenissimpanan = '$request->id'");
        return redirect()->back();
    }
    public function anggota()
    {
        $record = Anggota::get();
        $jenis = Jenissimpanan::where('id_jenissimpanan', '4')->first();
        return view('admin.mod_master/anggota', compact('record', 'jenis'));
    }
    public function sim_anggota(request $request)
    {
        $foto = $request->foto;
        $rename = date('dmYHis') . "." . $foto->extension();
        $foto->move('foto_anggota', $rename);

        $tgl_input = date('Y-m-d');
        Anggota::insert([
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nama_anggota' => $request->nama_anggota,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'tgl_masuk' => $request->tgl_masuk,
            'rekening' => $request->rekening,
            'gaji_bersih' => $request->gaji_bersih,
            'telp' => $request->telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'id_users' => Session::get('id'),
            'tgl_input' => $tgl_input,
            'foto' => $rename,
        ]);
        $anggota = Anggota::where('nik', $request->nik)->first();
        Simpanan::insert([
            'id_jenissimpanan' => '4',
            'besar_simpanan' => $request->pokok,
            'id_anggota' => $anggota->id_anggota,
            'id_user' => Session::get('id'),
            'id_users'=> Session::get('id'),
            'tgl_simpan' => $tgl_input,
            'foto' => '',
            'status' => '1',
        ]);

        return redirect()->back();
    }
    public function hap_anggota($id)
    {

        DB::delete("delete from tb_anggota where id_anggota ='$id' ");
        return redirect()->back();
    }
    public function ed_anggota(request $request)
    {
        $foto = $request->foto;
        if ($foto == null) {
            DB::update("update tb_anggota set
            nik = '$request->nik',
            nip = '$request->nip',
    		nama_anggota = '$request->nama_anggota',
    		alamat = '$request->alamat',
    		jenis_kelamin = '$request->jenis_kelamin',
    		golongan = '$request->golongan',
    		satuan_kerja = '$request->satuan_kerja',
     		pekerjaan = '$request->pekerjaan',
    		gaji_bersih = '$request->gaji_bersih',
    		tgl_masuk = '$request->tgl_masuk',
    		telp = '$request->telp',
            tempat_lahir = '$request->tempat_lahir',
    		tgl_lahir = '$request->tgl_lahir'
            where id_anggota = '$request->id'");
            return redirect()->back();
        } else {
             $rename = date('dmYHis') . "." . $foto->extension();
            $foto->move('foto_anggota', $rename);
            DB::update("update tb_anggota set
            nik = '$request->nik',
            nip = '$request->nip',
    		nama_anggota = '$request->nama_anggota',
    		alamat = '$request->alamat',
    		golongan = '$request->golongan',
    		satuan_kerja = '$request->satuan_kerja',
    		jenis_kelamin = '$request->jenis_kelamin',
    		pekerjaan = '$request->pekerjaan',
    		gaji_bersih = '$request->gaji_bersih',
    		tgl_masuk = '$request->tgl_masuk',
    		telp = '$request->telp',
            tempat_lahir = '$request->tempat_lahir',
    		tgl_lahir = '$request->tgl_lahir',
    		foto = '$rename'
             where id_anggota = '$request->id'");
            return redirect()->back();
        }
    }
    public function informasi()
    {
        $informasi = Information::get();
        return view('admin.mod_master/informasi', compact('informasi'));
    }
    public function edit_informasi(request $request)
    {
        $information = Information::where('id_information', $request->id)->first();
        if (isset($request->image)) {
            File::delete(public_path('information/' . $information->bg_image));
            $foto = $request->image;
            $rename = date('dmYHis') . "." . $foto->extension();
            $foto->move('information', $rename);

            Information::where('id_information', $request->id)->update([
                'information' => $request->informasi,
                'bg_color' => $request->color,
                'bg_image' => $rename,
            ]);
        } else {
            Information::where('id_information', $request->id)->update([
                'information' => $request->informasi,
                'bg_color' => $request->color,
            ]);
        }
        return redirect()->back();
    }
    public function tambah_informasi(request $request)
    {
        $foto = $request->image;
        $rename = date('dmYHis') . "." . $foto->extension();
        $foto->move('information', $rename);
        Information::create([
            'information' => $request->informasi,
            'bg_color' => $request->color,
            'bg_image' => $rename,
            'id_users' => Session::get('id'),
        ]);
        return redirect()->back();
    }
    public function hapus_informasi($id)
    {
        $information = Information::where('id_information', $id)->first();
        File::delete(public_path('information/' . $information->bg_image));
        Information::where('id_information', $id)->delete();
        return redirect()->back();
    }

    public function logout(request $request)
    {
        $request->session()->flush();

        return redirect()->to('/');
    }

    public function panduan()
    {
        return view('admin.mod_dokumentasi.panduan');
    }

    public function jenisBank()
    {
        $bank = Bank::orderBy('id_bank', 'asc')->get();
        return view('admin.mod_master.bank', compact('bank'));
    }

    public function tambahBank(request $request)
    {
        Bank::insert(["nama_bank" => strtoupper($request->bank)]);

        return redirect()->back();
    }

    public function deleteBank($id)
    {
        Bank::where('id_bank', $id)->delete();

        return redirect()->back();
    }

    public function jenisTransaksi()
    {
        $jenistransaksi = JenisTransaksi::orderBy('id_jenis_transaksi', 'desc')->get();

        return view("admin.mod_master.jenis_transaksi", compact('jenistransaksi'));
    }

    public function tambahJenisTransaksi(request $request)
    {
        JenisTransaksi::insert([
            "nama_jenis_transaksi" => $request->nama_jenis_transaksi,
            "ket" => $request->ket,
        ]);

        return redirect()->back();
    }

    public function kategoriTransaksi()
    {
        $kategori = KategoriTransaksi::leftjoin('jenistransaksi', 'jenistransaksi.id_jenis_transaksi', '=', 'kategori_transaksi.id_jenis_transaksi')->orderBy('id_kategori_transaksi', 'desc')->get();

        $jenistransaksi = JenisTransaksi::orderBy('id_jenis_transaksi', 'desc')->get();

        return view("admin.mod_master.kategori-transaksi", compact('kategori', 'jenistransaksi'));
    }

    public function tambahKategoriTransaksi(request $request)
    {
        KategoriTransaksi::insert([
            "nama_kategori" => $request->nama_kategori,
            "kode" => $request->kode,
            "id_jenis_transaksi" => $request->id_jenis_transaksi,
        ]);

        return redirect()->back();
    }

    public function uploadAnggota(request $request)
    {
        $file = $request->file;
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('import-anggota', $nama_file);
        Excel::import(new ImportAnggota, public_path("import-anggota/$nama_file"));

        return redirect()->back();
    }
    public function uploadPengajuan(request $request)
    {
        $file = $request->file;
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('import-peminjaman', $nama_file);
        Excel::import(new ImportPeminjaman, public_path("import-peminjaman/$nama_file"));
        
        return redirect()->back();
    }
    
    public function privacyPolicy() {
        return view('admin.mod_master.privacy-policy');
    }
    
    public function uploadSimpanan(request $request) {
        $file = $request->file;
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('import-simpanan', $nama_file);
        Excel::import(new ImportSimpanan, public_path("import-simpanan/$nama_file"));
    }
}
