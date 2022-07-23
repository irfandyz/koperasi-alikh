<?php

namespace App\Imports;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pengajuan;

use Maatwebsite\Excel\Concerns\ToModel;

class ImportSimpanan implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $date = date('Y-m-d');
        $id = [];
        
        $value = [];
        
        $anggota = Anggota::where('nip',$row[0])->get();
        
        foreach($anggota as $dt) {
            $value[] = [
                "id_anggota" => $dt->id_anggota,
                "besar_simpanan" => $row[1],
                "id_jenissimpanan" => $row[2],
                "id_users"=>7,
                "tgl_simpan" => $date,
                "foto"=>null,
                "status"=>1,
                "id_user"=>7,
            ];
        }
        Simpanan::insert($value);
    }
}
