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
                    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Paket Wisata
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                @foreach ($paketwisatas as $paketwisata)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $paketwisata->title }}</td>
                                        <td>{{ Str::limit($paketwisata->description, 50) }}</td>
                                        <td>Rp {{ number_format($paketwisata->price, 0, ',', '.') }}</td>
                                        <td>{{ $paketwisata->start_date->format('d-m-Y') }}</td>
                                        <td>{{ $paketwisata->end_date->format('d-m-Y') }}</td>
                                        <td>{{ $paketwisata->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="#" method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin mau hapus berita ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                                <p class="text-muted">Belum ada data berita</p>
                                                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Tambah Berita Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse --}}
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
                    [4, "desc"]
                ], // Sort by created_at desc
                "columnDefs": [{
                        "orderable": false,
                        "targets": [1, 5]
                    } // Disable sorting for image and action columns
                ]
            });
        });
    </script>
@endpush
