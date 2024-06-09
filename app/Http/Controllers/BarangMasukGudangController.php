<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangMasukGudangController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('barang.kategori')->get();
        $barangs = Barang::with('kategori')->get();
        return view('gudang.barangs_masuk.index', compact('barangMasuks', 'barangs'));
    }

    public function create()
    {
        $barangs = Barang::with('kategori')->get();
        return view('gudang.barangs_masuk.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_transaksi' => 'required',
            'tanggal' => 'required|date',
            'qty' => 'required|integer',
            'total' => 'required|numeric',
            'barang_id' => 'required|exists:barangs,id',
        ]);

        BarangMasuk::create($request->all());

        $barang = Barang::findOrFail($request->barang_id);
        $barang->stok += $request->qty;
        $barang->save();

        return redirect()->route('gudang.gudang_barangs_masuk.index')->with('success', 'Barang berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_transaksi' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->no_transaksi = $request->input('no_transaksi');
        $barangMasuk->tanggal = $request->input('tanggal');
        $barangMasuk->save();

        return redirect()->route('gudang.gudang_barangs_masuk.index')->with('success', 'Data barang masuk berhasil diperbarui');
    }
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();
        return redirect()->route('gudang.gudang_barangs_masuk.index')->with('success', 'Barang berhasil dihapus');
    }
}
