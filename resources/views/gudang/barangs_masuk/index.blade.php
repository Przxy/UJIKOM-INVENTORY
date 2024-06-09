@extends('layout.app_gudang')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Barang Masuk</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="text-right">
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal"><i
                        class="fas fa-plus "></i> Tambah Data</a>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <table id="table" class="table table-hover table-bordered  mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangMasuks as $barangMasuk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barangMasuk->no_transaksi }}</td>
                            <td>{{ $barangMasuk->barang->nama_barang }}</td>
                            <td>{{ $barangMasuk->barang->kategori->nama_kategori }}</td>
                            <td>{{ $barangMasuk->tanggal }}</td>
                            <td>{{ $barangMasuk->qty }}</td>
                            <td>Rp.{{ $barangMasuk->total }}</td>
                            <td>
                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                    data-target="#editModal{{ $barangMasuk->id }}">Edit</a>
                                <form action="{{ route('gudang.gudang_barangs_masuk.destroy', $barangMasuk->id) }}"
                                    method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus barang masuk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
            </div>

            <!-- Tabel data barang masuk -->
            
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Barang Masuk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="createForm" action="{{ route('gudang.gudang_barangs_masuk.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="no_transaksi" class="form-label">No Transaksi</label>
                                <input type="text" class="form-control" id="no_transaksi" name="no_transaksi" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="barang_id" class="form-label">Barang</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="barang_search" placeholder="Cari Barang"
                                        readonly>
                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                        data-target="#barangModal">Cari</button>
                                </div>
                                <input type="hidden" id="barang_id" name="barang_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="text" class="form-control" id="stok" name="stok" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Qty Masuk</label>
                                <input type="number" class="form-control" id="qty" name="qty" required>
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label">Total</label>
                                <input type="number" class="form-control" id="total" name="total" required
                                    readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Pencarian Barang -->
        <div class="modal fade" id="barangModal" tabindex="-1" aria-labelledby="barangModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="barangModalLabel">Pencarian Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->kategori->nama_kategori }}</td>
                                        <td>{{ $barang->harga }}</td>
                                        <td>{{ $barang->stok }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary pilih-barang"
                                                data-id="{{ $barang->id }}" data-nama="{{ $barang->nama_barang }}"
                                                data-harga="{{ $barang->harga }}" data-stok="{{ $barang->stok }}"
                                                data-dismiss="modal">Pilih</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($barangMasuks as $barangMasuk)
            <div class="modal fade" id="editModal{{ $barangMasuk->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel{{ $barangMasuk->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $barangMasuk->id }}">Edit Barang Masuk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('gudang.gudang_barangs_masuk.update', $barangMasuk->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Isi formulir dengan data barang masuk yang ingin diubah -->
                                <div class="mb-3">
                                    <label for="no_transaksi" class="form-label">No Transaksi</label>
                                    <input type="text" class="form-control" id="no_transaksi" name="no_transaksi"
                                        value="{{ $barangMasuk->no_transaksi }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                        value="{{ $barangMasuk->tanggal }}" required>
                                </div>
                                <!-- Isi formulir dengan data lainnya sesuai kebutuhan -->
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.pilih-barang').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var nama = this.getAttribute('data-nama');
                    var harga = this.getAttribute('data-harga');
                    var stok = this.getAttribute('data-stok');

                    document.getElementById('barang_id').value = id;
                    document.getElementById('barang_search').value = nama;
                    document.getElementById('harga').value = harga;
                    document.getElementById('stok').value = stok;
                });
            });

            document.getElementById('qty').addEventListener('input', function() {
                var qty = this.value;
                var harga = document.getElementById('harga').value;

                document.getElementById('total').value = qty * harga;
            });
        });
    </script>
@endsection
