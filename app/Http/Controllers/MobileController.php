<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Session;
use Auth;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class MobileController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function mobileBanner()
    {
        $banner = Banner::orderBy('id_banner', 'ASC')->get();

        return view('admin.mod_mobile.mobile_banner', compact("banner"));
    }

    public function tambahBanner(request $request)
    {
        $fileName = time() . rand(111, 999) . '.' . $request->banner->extension();

        $request->banner->move('banner', $fileName);

        Banner::insert([
            "banner_name" => $fileName,
            "aktif" => 'Y',
        ]);

        return redirect()->back();
    }

    public function updateBanner($id, $val)
    {


        if ($val == 1) {
            $query = Banner::where('id_banner', $id)->update([
                'aktif' => 'Y',
            ]);

            if ($query) {
                return redirect()->back()->with('message', 'Berhasil');
            } else {
                return redirect()->back()->with('message', 'Gagal');
            }
        } else {
            $query = Banner::where('id_banner', $id)->update([
                'aktif' => 'N',
            ]);

            if ($query) {
                return redirect()->back()->with('message', 'Berhasil');
            } else {
                return redirect()->back()->with('message', 'Gagal');
            }
        }
    }
}
