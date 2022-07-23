<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kartukop;
use App\Models\Online;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public $statusCode = 200;

    public function registerUser(Request $request)
    {
        $check = Anggota::where('username', $request->username)->first();
        if (!$check) {

            $query = Anggota::where('nik', $request->no_ktp)->orWhere('nip', $request->no_nip)->orWhere('telp', $request->no_hp)->update([
                "username" => strtolower($request->username),
                "password" => bcrypt($request->password),
                "email" => strtolower($request->email),
            ]);

            if (isset($query)) {
                $data = Anggota::where('username', $request->username)->first();

                $response = [
                    "message" => "success",
                    "user" => $data,
                ];

                return response()->json($response, $this->statusCode);
            } else {
                $response = [
                    "message" => "No telpon atau NIK tidak ditemukan",
                ];

                return response()->json($response, $this->statusCode);
            }
        } else {
            return response()->json(['message' => 'Username sudah tersedia'], $this->statusCode);
        }
    }

    public function loginUser(request $request)
    {
        if (Auth::guard('anggota')->attempt(['username' => $request->username, 'password' => $request->password])) {
            $query = Auth::guard('anggota')->user();
            $query2 = Kartukop::rightJoin('tb_anggota', 'tb_anggota.id_anggota', '=', 'tb_kartukop.id_anggota')->where('tb_anggota.id_anggota', $query->id_anggota)->first();
            $query3 = Simpanan::where('id_anggota', $query->id_anggota)->where('id_jenissimpanan', '4')->first();
            if ($query3) {
                $response = [
                    "message" => "Berhasil",
                    "user" => $query2,
                ];
                return response()->json($response, $this->statusCode, );
            } else {
                return response()->json(['message' => 'Anda belum membayar simpanan pokok'], $this->statusCode);
            }
        } else {
            return response()->json(['message' => 'Username atau Password Salah'], $this->statusCode);
        }
    }

    public function updateFotoKTP(request $request)
    {
        $imageName = time() . '.' . $request->foto_ktp->extension();

        Anggota::where('id_anggota', $request->id_anggota)->update([
            'foto_ktp' => $imageName,
        ]);

        $request->foto_ktp->move('foto_ktp', $imageName);

        $response = [
            'message' => 'berhasil',
        ];

        return response()->json($response, $this->statusCode);
    }

    public function createKodePin(request $request)
    {
        $query = Anggota::where('id_anggota', $request->id_anggota)->update([
            'kode_pin' => $request->kode_pin,
        ]);

        if (isset($query)) {
            Kartukop::insert([
                "id_anggota" => $request->id_anggota,
                "nomor_kartu" => rand(1000000000000000, 9999999999999999),
                "dibuat" => date('Y-m-d'),
                "berakhir" => date('Y-m-d', strtotime('+3 year')),
            ]);

            $response = [
                'message' => '1',
            ];

            return response()->json($response, $this->statusCode);
        }
    }

    public function verifKodePin(request $request)
    {
        $query = Anggota::where('id_anggota', $request->id_anggota)->first();
        if ($query->kode_pin == $request->kode_pin) {
            return response()->json(['message' => 1], 200);
        } else {
            return response()->json(['message' => 0], 200);
        }
    }

    public function checkUser(request $request)
    {
        if (Auth::guard('anggota')->attempt(['username' => $request->username, 'password' => $request->password])) {
            $query = Auth::guard('anggota')->user();
            return response()->json(['message' => 1, 'id' => $query->id_anggota], $this->statusCode);
        } else {
            return response()->json(['message' => 0], $this->statusCode);
        }
    }

    public function changeKodePin(request $request)
    {
        Anggota::where('id_anggota', $request->id_anggota)->update([
            'kode_pin' => $request->kode_pin,
        ]);
        return response()->json(['message' => 'berhasil'], $this->statusCode);
    }

    public function PostLogin(request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $online = Online::whereDate('created_at', '=', date('Y-m-d'))->first();
            if ($online == null) {
                Online::create([
                    'user_id' => Auth::user()->id_users,
                    'hours' => date('H:i:s'),
                ]);
            } else {
                Online::where('id', $online->id)->update([
                    'hours' => date('H:i:s'),
                ]);

            }
            Session::put([
                'id' => Auth::user()->id_users,
                'username' => Auth::user()->username,
                'email' => Auth::user()->email,
                'nama_lengkap' => Auth::user()->nama_lengkap,
                'no_telp' => Auth::user()->no_telp,
                'level' => Auth::user()->level,
                'menu_id' => Auth::user()->menu_id,
                'submenu_id' => Auth::user()->submenu_id,
            ]);
            return redirect('admin/dashboard');
        }
        return redirect()->back()->with('message', 'Username or Password is Wrong');
    }
}
