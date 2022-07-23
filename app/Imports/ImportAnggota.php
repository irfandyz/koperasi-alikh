<?php

namespace App\Imports;

use App\Models\Anggota;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAnggota implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // $data = [];
        // $data[] = [
        //     "nik" => $row[0],
        //     "nip" => $row[1],
        //     "nama_anggota" => $row[2],
        //     "alamat" => $row[3],
        //     "jenis_Kelamin" => $row[4],
        //     "pekerjaan" => $row[5],
        //     // "tgl_masuk" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]),
        //     "tgl_masuk" => $row[6],
        //     "telp" => $row[7],
        //     "gaji_bersih" => $row[8],
        //     "tempat_lahir" => $row[9],
        //     // "tgl_lahir" => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10]),
        //     "tgl_lahir" => $row[10],
        //     "rekening" => $row[11],
        //     "id_users" => Session::get('id'),
        //     "tgl_input" => date("Y-m-d"),
        // ];
        // Anggota::insert($data);
        Anggota::where('nip',$row[0])->update([
            "username"=>substr($row[0],0,10),
            "password"=>Hash::make($row[1]),
            "email"=>"example@example.com",
        ]);
    }
}
