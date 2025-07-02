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
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                id="price" placeholder="Masukkan harga paket..." required
                                value="{{ old('price', isset($paketwisata) ? $paketwisata->price : '') }}"
                                pattern="[0-9,.]+" inputmode="numeric">
                            <small class="form-text text-muted">Masukkan harga dalam Rupiah (contoh: 800000 atau
                                800.000)</small>
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
                            <label for="image">Ganti Gambar (Opsional)</label>
                            <input type="file" name="image"
                                class="form-control-file @error('image') is-invalid @enderror" id="image"
                                accept="image/*">
                            <small class="form-text text-muted">Format: jpeg, png, jpg, gif. Maksimal 2MB. Kosongkan jika
                                tidak ingin mengganti gambar.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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

        // Set minimum date to today for start_date (hanya untuk create)
        document.getElementById('start_date').min = new Date().toISOString().split('T')[0];

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

        // Set initial min for end_date (untuk edit)
        const currentStartDate = document.getElementById('start_date').value;
        if (currentStartDate) {
            document.getElementById('end_date').min = currentStartDate;
        }

        // Price input handling - PERBAIKAN UTAMA
        const priceInput = document.getElementById('price');
        let isFormatting = false;

        // Format price display with thousand separators
        function formatPrice(value) {
            // Remove all non-digits
            const numericValue = value.toString().replace(/\D/g, '');
            if (numericValue === '') return '';
            return parseInt(numericValue).toLocaleString('id-ID');
        }

        // Handle input event
        priceInput.addEventListener('input', function(e) {
            if (isFormatting) return;

            isFormatting = true;
            const cursorPosition = e.target.selectionStart;
            const oldValue = e.target.value;
            const numericValue = oldValue.replace(/\D/g, '');

            if (numericValue) {
                const formattedValue = formatPrice(numericValue);
                e.target.value = formattedValue;

                // Restore cursor position
                const newCursorPosition = cursorPosition + (formattedValue.length - oldValue.length);
                setTimeout(() => {
                    e.target.setSelectionRange(newCursorPosition, newCursorPosition);
                }, 0);
            }

            isFormatting = false;
        });

        // Handle focus - remove formatting for easier editing
        priceInput.addEventListener('focus', function(e) {
            const numericValue = e.target.value.replace(/\D/g, '');
            e.target.value = numericValue;
        });

        // Handle blur - add formatting back
        priceInput.addEventListener('blur', function(e) {
            if (e.target.value) {
                e.target.value = formatPrice(e.target.value);
            }
        });

        // Remove formatting before form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const priceInput = document.getElementById('price');
            const numericValue = priceInput.value.replace(/\D/g, '');
            priceInput.value = numericValue;
        });

        // Format initial price value on page load (untuk edit)
        window.addEventListener('load', function() {
            const priceInput = document.getElementById('price');
            if (priceInput.value && !priceInput.value.includes('.')) {
                priceInput.value = formatPrice(priceInput.value);
            }
        });
    </script>
@endsection
