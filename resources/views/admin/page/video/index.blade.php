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
            <h1 class="h3 mb-2 text-gray-800">Video</h1>
            <p class="mb-4">Kelola semua video yang ditampilkan di website Anda. Anda dapat menambah, mengedit, atau
                menghapus video sesuai kebutuhan.</p>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ route('admin.video.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Video
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Judul</th>
                                    <th>Video</th>
                                    <th>Dibuat pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($videos as $video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $video->title }}</td>
                                        <td>
                                            <iframe width="200" height="100" src="{{ $video->url }}" frameborder="0"
                                                allowfullscreen loading="lazy"></iframe>
                                        </td>
                                        <td>{{ $video->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.video.edit', $video->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.video.destroy', $video->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin mau hapus video \'{{ $video->title }}\' ini?')">
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
                                        <td colspan="5" class="text-center">
                                            <div class="py-4">
                                                <i class="fas fa-video fa-3x text-muted mb-3"></i>
                                                <p class="text-muted">Belum ada video yang ditambahkan.</p>
                                                <a href="{{ route('admin.video.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Tambah Video Pertama
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
