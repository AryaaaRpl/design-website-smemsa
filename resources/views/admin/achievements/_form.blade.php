@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: isi prestasi --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Isi Prestasi</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title" class="form-label">Judul <span class="required">*</span></label>
                    <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $achievement->title) }}"
                        placeholder="Juara 1 Lomba Kompetensi Siswa (LKS) ..." required>
                    @error('title') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $achievement->slug) }}">
                    <div class="form-help">Kosongkan agar dibuat otomatis dari judul.</div>
                    @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="excerpt" class="form-label">Ringkasan</label>
                    <textarea id="excerpt" name="excerpt" class="form-input" rows="2">{{ old('excerpt', $achievement->excerpt) }}</textarea>
                    <div class="form-help">Tampil di kartu katalog. Maks. 500 karakter.</div>
                    @error('excerpt') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi Lengkap</label>
                    <textarea id="description" name="description" class="form-input" rows="10">{{ old('description', $achievement->description) }}</textarea>
                    <div class="form-help">Tampil di modal detail. Pisahkan paragraf dengan satu baris kosong.</div>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: detail --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Kejuaraan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="rank" class="form-label">Predikat</label>
                    <input type="text" id="rank" name="rank" class="form-input"
                        value="{{ old('rank', $achievement->rank) }}" placeholder="MEDALI EMAS NASIONAL">
                    <div class="form-help">Tampil sebagai label di kartu. Kosongkan untuk memakai tingkat.</div>
                    @error('rank') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="level" class="form-label">Tingkat <span class="required">*</span></label>
                    <select id="level" name="level" class="form-input" required>
                        @foreach ($levels as $level)
                            <option value="{{ $level->value }}" @selected(old('level', $achievement->level?->value) === $level->value)>
                                {{ $level->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('level') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="achieved_at" class="form-label">Tanggal Capaian <span class="required">*</span></label>
                    <input type="date" id="achieved_at" name="achieved_at" class="form-input"
                        value="{{ old('achieved_at', $achievement->achieved_at?->format('Y-m-d')) }}" required>
                    <div class="form-help">Website menampilkan bulan & tahun, contoh: Maret 2026.</div>
                    @error('achieved_at') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" id="location" name="location" class="form-input"
                        value="{{ old('location', $achievement->location) }}" placeholder="Malang, Jawa Timur">
                    @error('location') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="organizer" class="form-label">Penyelenggara</label>
                    <input type="text" id="organizer" name="organizer" class="form-input"
                        value="{{ old('organizer', $achievement->organizer) }}">
                    @error('organizer') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $achievement->is_featured))
                            @if ($currentHeadline) data-toggle-target="headline-warning" @endif>
                        Jadikan prestasi unggulan
                    </label>
                    <div class="form-help">
                        Tampil di bagian "Mahkota Prestasi".
                        @if ($currentHeadline)
                            Unggulan saat ini: <strong>{{ $currentHeadline->title }}</strong>
                        @endif
                    </div>
                    @if ($currentHeadline)
                        <div class="alert alert-inline" id="headline-warning" @unless (old('is_featured', $achievement->is_featured)) hidden @endunless>
                            Prestasi "{{ $currentHeadline->title }}" tidak lagi menjadi unggulan setelah prestasi ini disimpan.
                        </div>
                    @endif
                    @error('is_featured') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card form-card">
            <div class="card-header">Detail</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="category_id" class="form-label">Kategori <span class="required">*</span></label>
                    <select id="category_id" name="category_id" class="form-input" required>
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('category_id', $achievement->category_id) === (string) $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help">Dipakai untuk filter di halaman prestasi.</div>
                    @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="field_label" class="form-label">Bidang</label>
                    <input type="text" id="field_label" name="field_label" class="form-input"
                        value="{{ old('field_label', $achievement->field_label) }}" placeholder="Teknologi IT">
                    <div class="form-help">Judul besar di kartu. Kosongkan untuk memakai nama kategori.</div>
                    @error('field_label') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="major_id" class="form-label">Jurusan</label>
                    <select id="major_id" name="major_id" class="form-input">
                        <option value="">Tidak terkait jurusan</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}" @selected((string) old('major_id', $achievement->major_id) === (string) $major->id)>
                                {{ $major->code }} - {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('major_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Foto Dokumentasi</label>
                    @if ($achievement->image_url)
                        <img src="{{ $achievement->image_url }}" alt="Foto saat ini" class="thumb-wide">
                    @endif
                    <input type="file" id="image" name="image" class="form-input" accept="image/*">
                    <div class="form-help">JPG/PNG/WEBP, maks. 2 MB. Tampil di modal detail.</div>
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.achievements.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
