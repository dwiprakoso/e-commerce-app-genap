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
            <p class="mb-4">Kelola data pemesanan paket wisata dari member.</p>

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
                                        <td>
                                            <span
                                                class="badge 
                                                @if ($pemesanan->status == 'pending') badge-warning
                                                @elseif($pemesanan->status == 'dibayar') badge-info
                                                @elseif($pemesanan->status == 'diverifikasi') badge-primary
                                                @elseif($pemesanan->status == 'selesai') badge-success
                                                @elseif($pemesanan->status == 'dibatalkan') badge-danger
                                                @else badge-secondary @endif">
                                                {{ ucfirst($pemesanan->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($pemesanan->bukti_bayar)
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#buktiBayarModal{{ $pemesanan->id }}">
                                                    Lihat Bukti Bayar
                                                </button>
                                            @else
                                                <span class="text-muted">Tidak ada bukti bayar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}"
                                                class="btn btn-sm btn-warning" title="Edit Status">
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

            <!-- Modals for Bukti Bayar -->
            @foreach ($pemesanans as $pemesanan)
                @if ($pemesanan->bukti_bayar)
                    <!-- Modal Bukti Bayar -->
                    <div class="modal fade" id="buktiBayarModal{{ $pemesanan->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="buktiBayarModalLabel{{ $pemesanan->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="buktiBayarModalLabel{{ $pemesanan->id }}">
                                        Bukti Pembayaran - {{ $pemesanan->member->name }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $pemesanan->bukti_bayar) }}" class="img-fluid"
                                        alt="Bukti Pembayaran" style="max-height: 500px;">
                                </div>
                                <div class="modal-footer">
                                    <div class="mr-auto">
                                        <small class="text-muted">
                                            <strong>Paket:</strong> {{ $pemesanan->paketwisata->title }}<br>
                                            <strong>Total:</strong> Rp.
                                            {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                                        </small>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
@endsection
