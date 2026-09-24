@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: identitas --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Identitas</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap & Gelar <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $teacher->name) }}"
                        placeholder="Dinda Nurmawati, S.Kom" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="position" class="form-label">Jabatan / Mata Pelajaran <span class="required">*</span></label>
                    <input type="text" id="position" name="position" class="form-input"
                        value="{{ old('position', $teacher->position) }}" placeholder="Mata Pelajaran Umum" required>
                    <div class="form-help">Tampil di bawah nama pada kartu. Untuk Kepala Konsentrasi, isi "Ketua Program".</div>
                    @error('position') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-input" value="{{ old('nip', $teacher->nip) }}">
                        <div class="form-help">Opsional, tidak tampil di website.</div>
                        @error('nip') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $teacher->slug) }}">
                        <div class="form-help">Kosongkan agar dibuat otomatis.</div>
                        @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="quote" class="form-label">Kutipan</label>
                    <textarea id="quote" name="quote" class="form-input" rows="3">{{ old('quote', $teacher->quote) }}</textarea>
                    <div class="form-help">Hanya tampil untuk Kepala Sekolah & Wakil Kepala Sekolah (kartu besar).</div>
                    @error('quote') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: pengelompokan & foto --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Kategori & Tampilan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="category" class="form-label">Kategori <span class="required">*</span></label>
                    <select id="category" name="category" class="form-input" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->value }}" @selected(old('category', $teacher->category?->value) === $category->value)>
                                {{ $category->label() }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help">Kepala Sekolah & Wakil Kepala Sekolah hanya boleh satu orang dan tampil sebagai kartu besar.</div>
                    @error('category') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="major_id" class="form-label">Jurusan</label>
                    <select id="major_id" name="major_id" class="form-input">
                        <option value="">Tidak terkait jurusan</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}" @selected((string) old('major_id', $teacher->major_id) === (string) $major->id)>
                                {{ $major->code }} - {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help">Wajib untuk Kepala Konsentrasi Keahlian (tampil sebagai label di kartu).</div>
                    @error('major_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                        value="{{ old('sort_order', $teacher->sort_order) }}" required>
                    @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="photo" class="form-label">Foto</label>
                    @if ($teacher->photo_url)
                        <img src="{{ $teacher->photo_url }}" alt="Foto saat ini" class="thumb-wide" style="max-height: 220px; object-fit: contain;">
                    @endif
                    <input type="file" id="photo" name="photo" class="form-input" accept="image/*">
                    <div class="form-help">Disarankan WEBP potret, maks. 2 MB. Jika kosong, kartu menampilkan inisial nama.</div>
                    @error('photo') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $teacher->is_active))>
                        Tampilkan di website
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
