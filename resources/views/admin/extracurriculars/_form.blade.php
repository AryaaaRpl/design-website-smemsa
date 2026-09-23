@php
    // Array prestasi menjadi teks "satu baris satu prestasi" untuk textarea.
    $achievementLines = implode("\n", (array) old('achievements', $extracurricular->achievements ?? []));
@endphp

@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: isi --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Kartu</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label">Nama Ekstrakurikuler <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $extracurricular->name) }}"
                        placeholder="Hizbul Wathan (HW)" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $extracurricular->slug) }}">
                    <div class="form-help">Kosongkan agar dibuat otomatis dari nama.</div>
                    @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="tag" class="form-label">Label</label>
                    <input type="text" id="tag" name="tag" class="form-input" value="{{ old('tag', $extracurricular->tag) }}"
                        placeholder="Kepanduan Islami Wajib">
                    <div class="form-help">Tampil di atas judul kartu dan modal.</div>
                    @error('tag') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="short_description" class="form-label">Ringkasan</label>
                    <textarea id="short_description" name="short_description" class="form-input" rows="3">{{ old('short_description', $extracurricular->short_description) }}</textarea>
                    <div class="form-help">Tampil di kartu. Maks. 500 karakter.</div>
                    @error('short_description') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card form-card">
            <div class="card-header">Detail Program (Modal)</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi Lengkap</label>
                    <textarea id="description" name="description" class="form-input" rows="8">{{ old('description', $extracurricular->description) }}</textarea>
                    <div class="form-help">Pisahkan paragraf dengan satu baris kosong.</div>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="achievements" class="form-label">Prestasi & Penghargaan</label>
                    <textarea id="achievements" name="achievements" class="form-input" rows="3">{{ $achievementLines }}</textarea>
                    <div class="form-help">Satu prestasi per baris. Kosongkan jika tidak ada.</div>
                    @error('achievements.*') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: info & tampilan --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Info Latihan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="schedule" class="form-label">Jadwal Latihan</label>
                    <input type="text" id="schedule" name="schedule" class="form-input"
                        value="{{ old('schedule', $extracurricular->schedule) }}" placeholder="Jumat, 13:00 - 15:00 WIB">
                    @error('schedule') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="coach_name" class="form-label">Pembina</label>
                    <input type="text" id="coach_name" name="coach_name" class="form-input"
                        value="{{ old('coach_name', $extracurricular->coach_name) }}">
                    @error('coach_name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">Tempat Latihan</label>
                    <input type="text" id="location" name="location" class="form-input"
                        value="{{ old('location', $extracurricular->location) }}">
                    @error('location') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="audience" class="form-label">Terbuka Untuk</label>
                    <input type="text" id="audience" name="audience" class="form-input"
                        value="{{ old('audience', $extracurricular->audience) }}" placeholder="Kelas X & XI">
                    @error('audience') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card form-card">
            <div class="card-header">Tampilan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="card_style" class="form-label">Ukuran Kartu <span class="required">*</span></label>
                    <select id="card_style" name="card_style" class="form-input" required>
                        @foreach ($cardStyles as $style)
                            <option value="{{ $style->value }}" @selected(old('card_style', $extracurricular->card_style?->value) === $style->value)>
                                {{ $style->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('card_style') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                        value="{{ old('sort_order', $extracurricular->sort_order) }}" required>
                    @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Foto Kartu</label>
                    @if ($extracurricular->image_url)
                        <img src="{{ $extracurricular->image_url }}" alt="Foto kartu saat ini" class="thumb-wide">
                    @endif
                    <input type="file" id="image" name="image" class="form-input" accept="image/*">
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="modal_image" class="form-label">Foto Detail (Modal)</label>
                    @if ($extracurricular->modal_image)
                        <img src="{{ $extracurricular->modal_image_url }}" alt="Foto detail saat ini" class="thumb-wide">
                    @endif
                    <input type="file" id="modal_image" name="modal_image" class="form-input" accept="image/*">
                    <div class="form-help">Opsional. Jika kosong, modal memakai foto kartu. Maks. 2 MB per foto.</div>
                    @error('modal_image') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $extracurricular->is_active))>
                        Tampilkan di website
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.extracurriculars.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
