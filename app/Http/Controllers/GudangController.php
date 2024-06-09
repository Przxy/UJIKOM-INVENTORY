<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KategoriBarang;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index(){
        $barangs = Barang::all();
        $data = User::get();
        $datakategori = KategoriBarang::get();
        $databarang = Barang::get();
        $databarangmasuk = BarangMasuk::get();
        $totalUsers = $data->count();
        $totalKategori = $datakategori->count();
        $totalBarang = $databarang->count();
        $totalBarangMasuk = $databarangmasuk->count();

        return view('gudang.dashboard', compact('data', 'totalUsers', 'totalBarang','totalKategori', 'barangs', 'totalBarangMasuk'));
    }
}
