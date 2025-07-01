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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Pemesanan</h1>
            <p class="mb-4">Kelola data pemesanan paket wisata dari member.</p>

            <!-- Status Filter Cards -->
            <div class="row mb-4">
                <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemesanans->total() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $pemesanans->where('status', 'pending')->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('admin.pemesanan.export.excel') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <a href="{{ route('admin.pemesanan.export.pdf') }}" class="btn btn-danger ml-2">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
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
                                    <th>Tanggal Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pemesanans as $pemesanan)
                                    <tr>
                                        <td>{{ $loop->iteration + ($pemesanans->currentPage() - 1) * $pemesanans->perPage() }}
                                        </td>
                                        <td>
                                            @if ($pemesanan->member)
                                                {{ $pemesanan->member->name }}
                                            @else
                                                <span class="text-danger">Member tidak ditemukan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pemesanan->paketwisata)
                                                {{ $pemesanan->paketwisata->title }}
                                            @else
                                                <span class="text-danger">Paket tidak ditemukan</span>
                                            @endif
                                        </td>
                                        <td>{{ $pemesanan->jumlah_orang }} orang</td>
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
                                                    <i class="fas fa-eye"></i> Lihat Bukti
                                                </button>
                                            @else
                                                <span class="text-muted">Belum ada bukti</span>
                                            @endif
                                        </td>
                                        <td>{{ $pemesanan->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}"
                                                class="btn btn-sm btn-warning" title="Edit Status">
                                                <i class="fas fa-edit"></i>
                                            </a>
                    </div>
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            <div class="py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada data pemesanan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($pemesanans->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $pemesanans->appends(request()->query())->links() }}
                    </div>
                @endif
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
                                    Bukti Pembayaran -
                                    @if ($pemesanan->member)
                                        {{ $pemesanan->member->name }}
                                    @else
                                        Member tidak ditemukan
                                    @endif
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                @if (file_exists(storage_path('app/public/' . $pemesanan->bukti_bayar)))
                                    <img src="{{ asset('storage/' . $pemesanan->bukti_bayar) }}" class="img-fluid"
                                        alt="Bukti Pembayaran" style="max-height: 500px;"
                                        onerror="this.src='{{ asset('img/no-image.png') }}';">
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        File bukti pembayaran tidak ditemukan
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <div class="mr-auto">
                                    <small class="text-muted">
                                        <strong>Paket:</strong>
                                        @if ($pemesanan->paketwisata)
                                            {{ $pemesanan->paketwisata->title }}
                                        @else
                                            Paket tidak ditemukan
                                        @endif
                                        <br>
                                        <strong>Total:</strong> Rp.
                                        {{ number_format($pemesanan->total_harga, 0, ',', '.') }}<br>
                                        <strong>Tanggal:</strong> {{ $pemesanan->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                @if ($pemesanan->status == 'dibayar')
                                    <a href="{{ route('admin.pemesanan.verify', $pemesanan->id) }}"
                                        class="btn btn-success">Verifikasi Pembayaran</a>
                                @endif
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

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable if needed
            $('#dataTable').DataTable({
                "paging": false,
                "searching": false,
                "info": false,
                "ordering": true,
                "order": [
                    [7, "desc"]
                ] // Sort by date column
            });
        });
    </script>
@endpush
