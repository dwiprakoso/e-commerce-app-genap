@extends('admin.layouts.app')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">Edit Video</h1>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.video.update', $video->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Judul Video <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="title" placeholder="Masukkan judul video..." required
                                value="{{ old('title', $video->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="url">URL Video <span class="text-danger">*</span></label>
                            <input type="url" name="url" class="form-control @error('url') is-invalid @enderror"
                                id="url" placeholder="Masukkan URL video (YouTube, Vimeo, dll)..." required
                                value="{{ old('url', $video->url) }}">
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ atau https://youtu.be/dQw4w9WgXcQ
                            </small>
                        </div>

                        <!-- Current Video -->
                        @if ($video->url)
                            <div class="form-group">
                                <label>Video Saat Ini:</label>
                                <div>
                                    <iframe width="400" height="225" src="{{ $video->url }}" frameborder="0"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif

                        <!-- Preview New Video -->
                        <div class="form-group" id="videoPreview" style="display: none;">
                            <label>Preview Video Baru:</label>
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
                                <i class="fas fa-save"></i> Update
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
        // Store original URL for comparison
        const originalUrl = "{{ $video->url }}";

        // Preview video when URL is changed
        document.getElementById('url').addEventListener('input', function(e) {
            const url = e.target.value;
            const previewDiv = document.getElementById('videoPreview');
            const preview = document.getElementById('preview');

            // Only show preview if URL is different from original
            if (url && url !== originalUrl) {
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
