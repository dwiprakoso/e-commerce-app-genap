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
            <h1 class="h3 mb-2 text-gray-800">Paket Wisata</h1>
            <p class="mb-4">Kelola paket wisata dengan mudah.</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('admin.paket-wisata.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Paket Wisata
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Dimulai pada</th>
                                    <th>Berakhir pada</th>
                                    <th>Status</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($paketwisatas as $paketwisata)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($paketwisata->image_url)
                                                <img src="{{ asset('storage/' . $paketwisata->image_url) }}"
                                                    alt="{{ $paketwisata->title }}" class="img-thumbnail"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="text-center text-muted"
                                                    style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc;">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $paketwisata->title }}</td>
                                        <td>{{ Str::limit($paketwisata->description, 50) }}</td>
                                        <td>Rp {{ number_format($paketwisata->price, 0, ',', '.') }}</td>
                                        <td>{{ $paketwisata->start_date->format('d-m-Y') }}</td>
                                        <td>{{ $paketwisata->end_date->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($paketwisata->status == 'publish')
                                                <span class="badge badge-success">Publish</span>
                                            @else
                                                <span class="badge badge-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.paket-wisata.edit', $paketwisata->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.paket-wisata.destroy', $paketwisata->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin mau hapus paket wisata ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-suitcase-rolling fa-3x text-muted mb-3"></i>
                                                <p class="text-muted">Belum ada data paket wisata</p>
                                                <a href="{{ route('admin.paket-wisata.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Tambah Paket Wisata Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "order": [
                    [5, "desc"]
                ], // Sort by start_date desc
                "columnDefs": [{
                        "orderable": false,
                        "targets": [1, 8]
                    } // Disable sorting for image and action columns
                ]
            });
        });
    </script>
@endpush
