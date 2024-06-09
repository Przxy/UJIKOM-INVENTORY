<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('barang.kategori')->get();
        $barangs = Barang::with('kategori')->get();
        return view('admin.barangs_masuk.index', compact('barangMasuks', 'barangs'));
    }
}
