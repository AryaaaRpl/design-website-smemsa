@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="card form-card">
    <div class="card-header">Data Kategori</div>
    <div class="card-body">
        <div class="form-group">
            <label for="type" class="form-label">Tipe <span class="required">*</span></label>
            <select id="type" name="type" class="form-input" required>
                @foreach ($types as $type)
                    <option value="{{ $type->value }}" @selected(old('type', $category->type?->value) === $type->value)>
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>
            @error('type') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="name" class="form-label">Nama Kategori <span class="required">*</span></label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $category->name) }}"
                placeholder="Kegiatan Siswa" required>
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $category->slug) }}"
                placeholder="kegiatan">
            <div class="form-help">Kosongkan agar dibuat otomatis dari nama. Dipakai untuk filter di halaman website.</div>
            @error('slug') <div class="form-error">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
