@extends('admin.layouts.app')
@section('content')
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">Edit Paket Wisata</h1>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.paket-wisata.update', $paketwisata->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Judul Paket <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="title" placeholder="Masukkan judul paket wisata..." required
                                value="{{ old('title', $paketwisata->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                rows="5" placeholder="Masukkan deskripsi paket wisata..." required>{{ old('description', $paketwisata->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                id="price" placeholder="Masukkan harga paket..." required min="0" step="1000"
                                value="{{ old('price', $paketwisata->price) }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="date" name="start_date"
                                        class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                                        required value="{{ old('start_date', $paketwisata->start_date->format('Y-m-d')) }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">Tanggal Berakhir <span class="text-danger">*</span></label>
                                    <input type="date" name="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror" id="end_date" required
                                        value="{{ old('end_date', $paketwisata->end_date->format('Y-m-d')) }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Current Image -->
                        @if ($paketwisata->image_url)
                            <div class="form-group">
                                <label>Gambar Saat Ini:</label>
                                <div>
                                    <img src="{{ asset('storage/' . $paketwisata->image_url) }}"
                                        alt="{{ $paketwisata->title }}" class="img-thumbnail" style="max-width: 300px;">
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" id="status"
                                required>
                                <option value="">Pilih Status</option>
                                <option value="draft"
                                    {{ old('status', $paketwisata->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publish"
                                    {{ old('status', $paketwisata->status) == 'publish' ? 'selected' : '' }}>Publish
                                </option>
                            </select>
                            @error('status')
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
                            <a href="{{ route('admin.paket-wisata.index') }}" class="btn btn-secondary">
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

        // Update end_date minimum when start_date changes
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = this.value;
            const endDateInput = document.getElementById('end_date');
            endDateInput.min = startDate;

            // Clear end_date if it's before the new start_date
            if (endDateInput.value && endDateInput.value <= startDate) {
                endDateInput.value = '';
            }
        });

        // Set initial min for end_date
        const currentStartDate = document.getElementById('start_date').value;
        if (currentStartDate) {
            document.getElementById('end_date').min = currentStartDate;
        }

        // Format price input with thousand separators
        document.getElementById('price').addEventListener('input', function(e) {
            let value = e.target.value;
            // Remove non-digits
            value = value.replace(/\D/g, '');
            // Add thousand separators
            if (value) {
                e.target.value = parseInt(value).toLocaleString('id-ID');
            }
        });

        // Remove formatting before form submission
        document.querySelector('form').addEventListener('submit', function() {
            const priceInput = document.getElementById('price');
            priceInput.value = priceInput.value.replace(/\D/g, '');
        });

        // Format initial price value
        window.addEventListener('load', function() {
            const priceInput = document.getElementById('price');
            if (priceInput.value) {
                priceInput.value = parseInt(priceInput.value).toLocaleString('id-ID');
            }
        });
    </script>
@endsection
