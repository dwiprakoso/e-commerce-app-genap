@extends('admin.layouts.app')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Video</h1>

            <!-- Form Card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.video.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Judul Video <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="title" placeholder="Masukkan judul video..." required value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="url">URL Video <span class="text-danger">*</span></label>
                            <input type="url" name="url" class="form-control @error('url') is-invalid @enderror"
                                id="url" placeholder="Masukkan URL video (YouTube, Vimeo, dll)..." required
                                value="{{ old('url') }}">
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ atau https://youtu.be/dQw4w9WgXcQ
                            </small>
                        </div>

                        <!-- Preview Video -->
                        <div class="form-group" id="videoPreview" style="display: none;">
                            <label>Preview Video:</label>
                            <div>
                                <iframe id="preview" width="400" height="225" src="" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin.video.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <script>
        // Preview video when URL is entered
        document.getElementById('url').addEventListener('input', function(e) {
            const url = e.target.value;
            const previewDiv = document.getElementById('videoPreview');
            const preview = document.getElementById('preview');

            if (url) {
                let embedUrl = convertToEmbedUrl(url);
                if (embedUrl) {
                    preview.src = embedUrl;
                    previewDiv.style.display = 'block';
                } else {
                    previewDiv.style.display = 'none';
                }
            } else {
                previewDiv.style.display = 'none';
            }
        });

        // Convert YouTube URL to embed format
        function convertToEmbedUrl(url) {
            try {
                // If already embed URL, return as is
                if (url.includes('embed')) {
                    return url;
                }

                // Convert YouTube watch URL to embed URL
                if (url.includes('youtube.com/watch')) {
                    const urlParams = new URLSearchParams(new URL(url).search);
                    const videoId = urlParams.get('v');
                    if (videoId) {
                        return `https://www.youtube.com/embed/${videoId}`;
                    }
                }

                // Convert YouTube short URL to embed URL
                if (url.includes('youtu.be')) {
                    const videoId = url.split('/').pop().split('?')[0];
                    return `https://www.youtube.com/embed/${videoId}`;
                }

                // For other URLs, try to use as is
                return url;
            } catch (error) {
                return null;
            }
        }
    </script>
@endsection
