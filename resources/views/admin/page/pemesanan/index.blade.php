@extends('admin.layouts.app')
@section('content')
    <!-- Main Content -->
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Pemesanan</h1>
            <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                For more information about DataTables, please visit the <a target="_blank"
                    href="https://datatables.net">official DataTables documentation</a>.</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="#" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Member</th>
                                    <th>Paket Wisata</th>
                                    <th>Jumlah Orang</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Bukti Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanans as $pemesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pemesanan->member->name }}</td>
                                        <td>{{ $pemesanan->paketwisata->title }}</td>
                                        <td>{{ $pemesanan->jumlah_orang }}</td>
                                        <td>Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $pemesanan->status }}</td>
                                        <td>
                                            @if ($pemesanan->bukti_bayar)
                                                <a href="#" target="_blank">Lihat Bukti Bayar</a>
                                            @else
                                                Tidak ada bukti bayar
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Add action buttons here if needed -->
                                            <a href="#" class="btn btn-sm btn-info">
                                                <i class="fas fa-info"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
