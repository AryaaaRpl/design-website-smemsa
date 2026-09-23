@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="card form-card">
    <div class="card-header">Data Mitra</div>
    <div class="card-body form-grid">
        <div class="form-group">
            <label for="name" class="form-label">Nama Mitra <span class="required">*</span></label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $partner->name) }}"
                placeholder="PT. Semesta Multitekno" required>
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $partner->slug) }}">
            <div class="form-help">Kosongkan agar dibuat otomatis dari nama.</div>
            @error('slug') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="industry" class="form-label">Bidang Industri</label>
            <input type="text" id="industry" name="industry" class="form-input"
                value="{{ old('industry', $partner->industry) }}" placeholder="Teknologi Informasi">
            @error('industry') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="city" class="form-label">Kota</label>
            <input type="text" id="city" name="city" class="form-input"
                value="{{ old('city', $partner->city) }}" placeholder="Banyuwangi">
            @error('city') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="website" class="form-label">Website</label>
            <input type="url" id="website" name="website" class="form-input"
                value="{{ old('website', $partner->website) }}" placeholder="https://...">
            @error('website') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
            <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                value="{{ old('sort_order', $partner->sort_order) }}" required>
            @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="logo" class="form-label">Logo</label>
            @if ($partner->logo_url)
                <img src="{{ $partner->logo_url }}" alt="Logo saat ini" class="thumb thumb-preview">
            @endif
            <input type="file" id="logo" name="logo" class="form-input" accept="image/*">
            <div class="form-help">PNG/JPG/WEBP, maks. 2 MB. Kosongkan jika tidak diganti.</div>
            @error('logo') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <span class="form-label">Jurusan Terkait</span>
            <div class="checkbox-list">
                @foreach ($majors as $major)
                    <label class="form-check">
                        <input type="checkbox" name="majors[]" value="{{ $major->id }}"
                            @checked(in_array($major->id, old('majors', $selectedMajors)))>
                        {{ $major->code }}
                    </label>
                @endforeach
            </div>
            @error('majors.*') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group form-full">
            <label class="form-check">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $partner->is_active))>
                Tampilkan logo di daftar mitra (halaman BKK) & marquee beranda
            </label>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
