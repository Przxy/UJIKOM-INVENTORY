@extends('layout.app_admin')
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#printModal"><i class="fas fa-print"></i> Cetak Data</button>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <!-- Tabel data barang masuk -->
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printModalLabel">Pilih Rentang Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="printForm">
                    <div class="form-group">
                        <label for="startDate">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="endDate" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="confirmPrintButton">Cetak</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('confirmPrintButton').addEventListener('click', function() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        
        if (startDate && endDate) {
            // Close the modal
            $('#printModal').modal('hide');

            // Filter the table based on the selected date range
            const tableRows = document.querySelectorAll('#table tbody tr');
            tableRows.forEach(row => {
                const date = row.cells[4].innerText;
                if (date >= startDate && date <= endDate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Print the filtered table
            window.print();

            // Reset table display after printing
            setTimeout(() => {
                tableRows.forEach(row => {
                    row.style.display = '';
                });
            }, 1000);
        } else {
            alert('Silakan pilih rentang tanggal yang valid.');
        }
    });
</script>
@endsection
