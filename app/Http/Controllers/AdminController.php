<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KategoriBarang;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(){
        $data = User::get();
        $datakategori = KategoriBarang::get();
        $databarang = Barang::get();
        $databarangmasuk = BarangMasuk::get();
        $totalUsers = $data->count();
        $totalKategori = $datakategori->count();
        $totalBarang = $databarang->count();
        $totalBarangMasuk = $databarangmasuk->count();

        return view('admin.dashboard', compact('data', 'totalUsers', 'totalBarang','totalKategori','totalBarangMasuk'));
    }
}
