@extends('admin.layouts.app')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">Edit Status Pemesanan</h1>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Informasi Pemesanan (Read Only) -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Member</label>
                                    <input type="text" class="form-control" value="{{ $pemesanan->member->name }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Member</label>
                                    <input type="text" class="form-control" value="{{ $pemesanan->member->email }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Paket Wisata</label>
                                    <input type="text" class="form-control" value="{{ $pemesanan->paketwisata->title }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jumlah Orang</label>
                                    <input type="text" class="form-control" value="{{ $pemesanan->jumlah_orang }} orang"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Harga</label>
                                    <input type="text" class="form-control"
                                        value="Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pemesanan</label>
                                    <input type="text" class="form-control"
                                        value="{{ $pemesanan->created_at->format('d/m/Y H:i') }}" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Bukti Bayar -->
                        @if ($pemesanan->bukti_bayar)
                            <div class="form-group">
                                <label>Bukti Pembayaran Saat Ini:</label>
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $pemesanan->bukti_bayar) }}" class="img-thumbnail"
                                        alt="Bukti Pembayaran" style="max-width: 300px; max-height: 200px; cursor: pointer;"
                                        data-toggle="modal" data-target="#buktiBayarModal">
                                    <br>
                                    <small class="text-muted">Klik gambar untuk melihat ukuran penuh</small>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Bukti Pembayaran:</label>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i> Belum ada bukti pembayaran yang diupload
                                </div>
                            </div>
                        @endif

                        <!-- Status (Editable) -->
                        <div class="form-group">
                            <label for="status">Status Pemesanan <span class="text-danger">*</span></label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status"
                                required>
                                <option value="">-- Pilih Status --</option>
                                <option value="pending"
                                    {{ old('status', $pemesanan->status) == 'pending' ? 'selected' : '' }}>
                                    Pending - Menunggu Pembayaran
                                </option>
                                <option value="dibayar"
                                    {{ old('status', $pemesanan->status) == 'dibayar' ? 'selected' : '' }}>
                                    Dibayar - Sudah Melakukan Pembayaran
                                </option>
                                <option value="diverifikasi"
                                    {{ old('status', $pemesanan->status) == 'diverifikasi' ? 'selected' : '' }}>
                                    Diverifikasi - Pembayaran Terverifikasi
                                </option>
                                <option value="selesai"
                                    {{ old('status', $pemesanan->status) == 'selesai' ? 'selected' : '' }}>
                                    Selesai - Perjalanan Selesai
                                </option>
                                <option value="dibatalkan"
                                    {{ old('status', $pemesanan->status) == 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan - Pemesanan Dibatalkan
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Status saat ini:
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
                            </small>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Modal Bukti Bayar -->
    @if ($pemesanan->bukti_bayar)
        <div class="modal fade" id="buktiBayarModal" tabindex="-1" role="dialog" aria-labelledby="buktiBayarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="buktiBayarModalLabel">
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
                                <strong>Total:</strong> Rp. {{ number_format($pemesanan->total_harga, 0, ',', '.') }}<br>
                                <strong>Tanggal:</strong> {{ $pemesanan->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        // Show confirmation when changing status
        document.getElementById('status').addEventListener('change', function(e) {
            const currentStatus = "{{ $pemesanan->status }}";
            const newStatus = e.target.value;

            if (newStatus && newStatus !== currentStatus) {
                const statusText = e.target.options[e.target.selectedIndex].text;
                // Optional: You can add confirmation here if needed
                // if (!confirm(`Apakah Anda yakin ingin mengubah status menjadi ${statusText}?`)) {
                //     e.target.value = currentStatus;
                // }
            }
        });
    </script>
@endsection
