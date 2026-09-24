@php
    // Array sarana utama menjadi teks "satu baris satu sarana" untuk textarea.
    $featureLines = implode("\n", (array) old('features', $facility->features ?? []));
    $mapX = old('map_x', $facility->map_x);
    $mapY = old('map_y', $facility->map_y);
@endphp

@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: isi & denah --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Informasi Fasilitas</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $facility->name) }}"
                        placeholder="Tefa SMEMSA Printing (DKV)" required>
                    <div class="form-help">Judul di panel detail & modal.</div>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="short_name" class="form-label">Nama Pendek</label>
                        <input type="text" id="short_name" name="short_name" class="form-input"
                            value="{{ old('short_name', $facility->short_name) }}" placeholder="Tefa SMEMSA Printing">
                        <div class="form-help">Untuk Daftar Lengkap, daftar TEFA & kartu grid.</div>
                        @error('short_name') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $facility->slug) }}">
                        <div class="form-help">Kosongkan agar dibuat otomatis.</div>
                        @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="tag" class="form-label">Label Kategori</label>
                        <input type="text" id="tag" name="tag" class="form-input" value="{{ old('tag', $facility->tag) }}"
                            placeholder="Teaching Factory · DKV">
                        @error('tag') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="location_label" class="form-label">Lokasi</label>
                        <input type="text" id="location_label" name="location_label" class="form-input"
                            value="{{ old('location_label', $facility->location_label) }}" placeholder="Sekolah Utara — Tenggara">
                        @error('location_label') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" name="description" class="form-input" rows="4">{{ old('description', $facility->description) }}</textarea>
                    <div class="form-help">Tampil di panel detail & modal.</div>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="features" class="form-label">Sarana Utama</label>
                    <textarea id="features" name="features" class="form-input" rows="4">{{ $featureLines }}</textarea>
                    <div class="form-help">Satu sarana per baris, tampil sebagai chip.</div>
                    @error('features.*') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="highlight" class="form-label">Nilai Tambah Pembelajaran</label>
                    <textarea id="highlight" name="highlight" class="form-input" rows="2">{{ old('highlight', $facility->highlight) }}</textarea>
                    @error('highlight') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card form-card">
            <div class="card-header">Titik di Denah</div>
            <div class="card-body">
                <p class="form-help" style="margin-top: 0;">
                    Klik pada denah untuk menaruh titik fasilitas ini. Titik abu-abu adalah fasilitas lain.
                    Kosongkan jika fasilitas tidak perlu tampil di denah.
                </p>

                <div class="map-picker" data-map-picker>
                    <svg class="campus-svg" viewBox="0 0 1000 800" role="img" aria-label="Denah sekolah untuk memilih titik">
                        @include('partials.campus-map')
                        @foreach ($otherPoints as $point)
                            <circle class="picker-other" cx="{{ $point->map_x }}" cy="{{ $point->map_y }}" r="10">
                                <title>{{ $point->name }}</title>
                            </circle>
                        @endforeach
                        <circle class="picker-marker" data-map-marker cx="{{ $mapX ?? 0 }}" cy="{{ $mapY ?? 0 }}" r="14"
                            @if ($mapX === null || $mapY === null) style="display: none" @endif />
                    </svg>
                </div>

                <div class="form-grid" style="margin-top: 12px;">
                    <div class="form-group">
                        <label for="map_x" class="form-label">Titik X (0–1000)</label>
                        <input type="number" id="map_x" name="map_x" class="form-input" min="0" max="1000"
                            value="{{ $mapX }}" data-map-x>
                        @error('map_x') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="map_y" class="form-label">Titik Y (0–800)</label>
                        <input type="number" id="map_y" name="map_y" class="form-input" min="0" max="800"
                            value="{{ $mapY }}" data-map-y>
                        @error('map_y') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <button type="button" class="btn btn-outline btn-sm" data-map-clear>Hapus Titik dari Denah</button>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: pengaturan & galeri --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Kategori & Tampilan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="type" class="form-label">Tipe <span class="required">*</span></label>
                    <select id="type" name="type" class="form-input" required>
                        @foreach ($types as $type)
                            <option value="{{ $type->value }}" @selected(old('type', $facility->type?->value) === $type->value)>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help">Teaching Factory = titik kuning di denah, lainnya titik biru.</div>
                    @error('type') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="major_id" class="form-label">Jurusan</label>
                    <select id="major_id" name="major_id" class="form-input">
                        <option value="">Tidak terkait jurusan</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}" @selected((string) old('major_id', $facility->major_id) === (string) $major->id)>
                                {{ $major->code }} - {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help">Tampil di bawah nama pada daftar TEFA.</div>
                    @error('major_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="mark" class="form-label">Kode Singkat</label>
                        <input type="text" id="mark" name="mark" class="form-input" maxlength="5"
                            value="{{ old('mark', $facility->mark) }}" placeholder="DKV">
                        @error('mark') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="icon" class="form-label">Ikon</label>
                        <select id="icon" name="icon" class="form-input">
                            @foreach ($icons as $icon)
                                <option value="{{ $icon->value }}" @selected(old('icon', $facility->icon?->value) === $icon->value)>
                                    {{ $icon->emoji() }} {{ $icon->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('icon') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan <span class="required">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                        value="{{ old('sort_order', $facility->sort_order) }}" required>
                    <div class="form-help">Menentukan nomor titik denah & urutan di daftar.</div>
                    @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="show_in_tefa_list" value="1" @checked(old('show_in_tefa_list', $facility->show_in_tefa_list))>
                        Tampilkan di daftar Teaching Factory
                    </label>
                    <label class="form-check" style="margin-top: 8px;">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $facility->is_featured))>
                        Tampilkan di grid Fasilitas Unggulan
                    </label>
                    <label class="form-check" style="margin-top: 8px;">
                        <input type="checkbox" name="is_wide" value="1" @checked(old('is_wide', $facility->is_wide))>
                        Kartu grid lebar
                    </label>
                </div>

                <div class="form-group">
                    <label for="short_description" class="form-label">Ringkasan Kartu Grid</label>
                    <textarea id="short_description" name="short_description" class="form-input" rows="3">{{ old('short_description', $facility->short_description) }}</textarea>
                    @error('short_description') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card form-card">
            <div class="card-header">Galeri Foto</div>
            <div class="card-body">
                @if ($facility->exists && $facility->images->isNotEmpty())
                    <div class="gallery-list">
                        @foreach ($facility->images as $image)
                            <div class="gallery-item">
                                <img src="{{ $image->url }}" alt="" class="gallery-thumb">
                                <div class="gallery-fields">
                                    <input type="text" name="images[{{ $image->id }}][caption]" class="form-input"
                                        value="{{ old("images.{$image->id}.caption", $image->caption) }}" placeholder="Keterangan (opsional)">
                                    <div class="gallery-row">
                                        <label class="form-help" style="margin: 0;">Urutan
                                            <input type="number" name="images[{{ $image->id }}][sort_order]" class="form-input gallery-order" min="0"
                                                value="{{ old("images.{$image->id}.sort_order", $image->sort_order) }}">
                                        </label>
                                        <label class="form-check">
                                            <input type="checkbox" name="images[{{ $image->id }}][delete]" value="1">
                                            Hapus
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="form-group" style="margin-top: 12px;">
                    <label for="new_images" class="form-label">Tambah Foto</label>
                    <input type="file" id="new_images" name="new_images[]" class="form-input" accept="image/*" multiple>
                    <div class="form-help">Bisa pilih beberapa foto sekaligus (maks. 10, 2 MB per foto, disarankan WEBP). Foto dengan urutan terkecil menjadi foto utama.</div>
                    @error('new_images') <div class="form-error">{{ $message }}</div> @enderror
                    @error('new_images.*') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.facilities.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
