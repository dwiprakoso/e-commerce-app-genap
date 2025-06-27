@extends('admin.layouts.app')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">Edit Gallery</h1>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" name="image"
                                class="form-control-file @error('image') is-invalid @enderror" id="image"
                                accept="image/*">
                            <small class="form-text text-muted">
                                Kosongkan jika tidak ingin mengubah gambar. Format yang didukung: JPG, JPEG, PNG, GIF.
                                Maksimal 2MB.
                            </small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        @if ($gallery->image_url)
                            <div class="form-group">
                                <label>Gambar Saat Ini:</label>
                                <div>
                                    <img src="{{ asset('storage/' . $gallery->image_url) }}" alt="{{ $gallery->caption }}"
                                        class="img-thumbnail" style="max-width: 300px;">
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="caption">Caption <span class="text-danger">*</span></label>
                            <textarea name="caption" class="form-control @error('caption') is-invalid @enderror" id="caption" rows="3"
                                placeholder="Masukkan caption untuk gambar..." required>{{ old('caption', $gallery->caption) }}</textarea>
                            @error('caption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview New Image -->
                        <div class="form-group" id="imagePreview" style="display: none;">
                            <label>Preview Gambar Baru:</label>
                            <div>
                                <img id="preview" src="#" alt="Preview" class="img-thumbnail"
                                    style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
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
