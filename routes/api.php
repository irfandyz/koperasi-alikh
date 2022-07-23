<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CooperativeController;
use App\Http\Controllers\AdminController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// AuthController
Route::controller(AuthController::class)->group(function () {
    Route::post('/registerUser', "registerUser");
    Route::post('/loginUser', "loginUser");
    Route::post('/updateFotoKtp', "updateFotoKTP");
    Route::post('/createKodePin', "createKodePin");
    Route::post('/verifKodePin', "verifKodePin");
    Route::post("/checkUser", "checkUser");
    Route::post("/changeKodePin", "changeKodePin");
});
Route::controller(CooperativeController::class)->group(function () {
    Route::get('/getKategori', 'getKategori');
    Route::get("/getJumlahAnggota", 'getJumlahAnggota');
    Route::get("/getJenisPinjaman", 'getJenisPinjaman');
    Route::get("/getJenisSimpanan", "getJenisSimpanan");
    Route::post('/simpan-pengajuan', "simpan_pengajuan");
    Route::get("/getInformation", "getInformation");
    Route::post('/addSimpanan', "addSimpanan");
    Route::get('/getTenor/{id}', "getTenor");
    Route::get('/getPengajuan/{id}', "getPengajuan");
    Route::get("/getJumlahAdmin", "getJumlahAdmin");
    Route::get("/getSimpan/{id}", "getSimpan");
    Route::get("/getSimpan", 'getSimpanan');
    Route::get("/getTabungan/{id}", "getTabungan");
    Route::post("/getHistory/{id}", 'getHistory');
    Route::post("/addPengambilan", "addPengambilan");
    Route::get("/getTransaksi/{id}", "getTransaksi");
    Route::get("/getPinjamanNotification/{id}", "getPinjamanNotification");
    Route::get('/getBanner', "getBanner");
    Route::get("/getLoanConf","getLoanConf");
    Route::get("/updateStatusLoan/{id}","updateStatusLoan");
});
Route::controller(AdminController::class)->group(function () {
    Route::post('/searchAnggota', 'searchAnggota');
});

    

// Api Routes 










