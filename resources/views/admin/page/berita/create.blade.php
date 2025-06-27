@extends('admin.layouts.app')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tambah Berita</h1>

            <!-- Form Card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="title" placeholder="Masukkan judul berita..." required value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Gambar <span class="text-danger">*</span></label>
                            <input type="file" name="image"
                                class="form-control-file @error('image') is-invalid @enderror" id="image"
                                accept="image/*" required>
                            <small class="form-text text-muted">
                                Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 2MB.
                            </small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Isi Berita <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="5"
                                placeholder="Masukkan isi berita..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview Image -->
                        <div class="form-group" id="imagePreview" style="display: none;">
                            <label>Preview Gambar:</label>
                            <div>
                                <img id="preview" src="#" alt="Preview" class="img-thumbnail"
                                    style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
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
        // Preview image before upload
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
