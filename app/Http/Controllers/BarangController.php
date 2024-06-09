<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KategoriBarang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $kategoris = KategoriBarang::all();
        return view('admin.barangs.index', compact('barangs', 'kategoris'));
    }
    
    public function create()
    {
        $kategori_barangs = KategoriBarang::all();
        return view('admin.barangs.create', compact('kategori_barangs'));
    }
    
    public function store(Request $request)
    {
        Barang::create($request->all());
        return redirect()->route('admin.barangs.index')->with('success', 'Barang berhasil ditambahkan');
    }
    
    public function edit(Barang $barang)
    {
        $kategori_barangs = KategoriBarang::all();
        return view('admin.barangs.edit', compact('barang', 'kategori_barangs'));
    }
    
    public function update(Request $request, Barang $barang)
    {
        $barang->update($request->all());
        return redirect()->route('admin.barangs.index');
    }
    
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barangs.index');
    }
    
}
