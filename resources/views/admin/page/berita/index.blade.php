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
            <h1 class="h3 mb-2 text-gray-800">Berita</h1>
            <p class="mb-4">Kelola berita foto website Anda dengan mudah.</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Berita
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="12%">Gambar</th>
                                    <th width="15%">Judul</th>
                                    <th width="50%">Isi</th>
                                    <th width="10%">Dibuat pada</th>
                                    <th width="8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($beritas as $berita)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($berita->image_url)
                                                <img src="{{ asset('storage/' . $berita->image_url) }}"
                                                    class="img-thumbnail"
                                                    style="width: 100px; height: 80px; object-fit: cover;"
                                                    alt="{{ $berita->title }}">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $berita->title }}</strong>
                                        </td>
                                        <td>
                                            @if (strlen($berita->content) > 150)
                                                {{ substr($berita->content, 0, 150) }}
                                                <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                                    class="text-primary font-weight-bold"
                                                    style="text-decoration: none; cursor: pointer;"
                                                    title="Klik untuk detail">...</a>
                                            @else
                                                {{ $berita->content }}
                                            @endif
                                        </td>
                                        <td>{{ $berita->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.berita.edit', $berita->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin mau hapus berita ini?')">
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
