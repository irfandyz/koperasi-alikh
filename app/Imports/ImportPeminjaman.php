<?php

namespace App\Imports;

use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengajuan;

use Maatwebsite\Excel\Concerns\ToModel;

class ImportPeminjaman implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $nik = [];
        $data = [];
        $kodePengajuan = [];

        $nik = [
            "nik" => $row[0],
        ];

        $anggota = Anggota::whereIn('nik', $nik)->get();

        foreach ($anggota as $dt) {
            $kode_pengajuan = rand(0000, 9999) . $dt->id_anggota . $row[1];
            $data[] = [
                "id_anggota" => $dt->id_anggota,
                "besar_pinjam" => $row[1],
                "tenor_lama" => $row[2],
                "bunga_dua" => $row[3],
                "tgl_pengajuan" => $row[4],
                "status" => 2,
                "id_users" => 1,
                "kode_pengajuan" => $kode_pengajuan,
            ];
            $kodePengajuan[] = [
                "kode_pengajuan" => $kode_pengajuan,
            ];
        }

        $check = Pengajuan::insert($data);

        if (isset($check)) {
            $peminjaman = [];
            $idPengajuan = [];
            $id_peminjaman = [];
            $update = [];
            $pengajuan = Pengajuan::whereIn('kode_pengajuan', $kodePengajuan)->get();
            foreach ($pengajuan as $dt) {
                $bunga = ($dt->besar_pinjam * ($dt->bunga_dua / 100));
                $lama = round($dt->besar_pinjam / $dt->tenor_lama);
                $total = $bunga + $lama;
                for ($i = 1; $i <= $dt->tenor_lama; $i++) {
                    $peminjaman[] = [
                        "id_pengajuan" => $dt->id_pengajuan,
                        "jumlah" => $total,
                        "status" => "N",
                    ];
                }
                $check2 = Peminjaman::insert($peminjaman);
                if (isset($check2)) {
                    $idPengajuan[] = [
                        "id_pengajuan" => $dt->id_pengajuan,
                    ];
                    $datum = Peminjaman::whereIn('id_pengajuan', $idPengajuan)->limit($row[5])->get();

                    foreach ($datum as $key) {
                        $update = [
                            "status" => "Y",
                        ];
                        $id_peminjaman[] = [
                            "id_peminjaman" => $key->id_peminjaman,
                        ];
                    }
                    Peminjaman::whereIn('id_peminjaman', $id_peminjaman)->update($update);
                }
            }
        }
    }
}
