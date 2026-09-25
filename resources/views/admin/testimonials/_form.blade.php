@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: alumni & motivasi --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Alumni</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label">Nama <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $testimonial->name) }}"
                        placeholder="Ahmad Rizqi Pratama" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="major_id" class="form-label">Jurusan</label>
                        <select id="major_id" name="major_id" class="form-input">
                            <option value="">Tidak dipilih</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" @selected((string) old('major_id', $testimonial->major_id) === (string) $major->id)>
                                    {{ $major->code }} - {{ $major->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('major_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="graduation_year" class="form-label">Tahun Lulus</label>
                        <input type="number" id="graduation_year" name="graduation_year" class="form-input"
                            value="{{ old('graduation_year', $testimonial->graduation_year) }}" placeholder="2025">
                        @error('graduation_year') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="role" class="form-label">Pekerjaan Sekarang</label>
                        <input type="text" id="role" name="role" class="form-input"
                            value="{{ old('role', $testimonial->role) }}" placeholder="Junior Web Developer">
                        @error('role') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="company" class="form-label">Perusahaan / Instansi</label>
                        <input type="text" id="company" name="company" class="form-input"
                            value="{{ old('company', $testimonial->company) }}" placeholder="PT Digital Kreatif Nusantara">
                        @error('company') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="quote" class="form-label">Motivasi / Cerita <span class="required">*</span></label>
                    <textarea id="quote" name="quote" class="form-input" rows="4" maxlength="400" required>{{ old('quote', $testimonial->quote) }}</textarea>
                    <div class="form-help">Maks. 400 karakter agar kartu di beranda tetap rapi.</div>
                    @error('quote') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: foto & tampilan --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Foto & Tampilan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="photo" class="form-label">Foto Profil</label>
                    @if ($testimonial->photo_url)
                        <img src="{{ $testimonial->photo_url }}" alt="Foto saat ini" class="thumb thumb-preview thumb-avatar">
                    @endif
                    <input type="file" id="photo" name="photo" class="form-input" accept="image/*">
                    <div class="form-help">Foto persegi, disarankan WEBP, maks. 2 MB. Jika kosong, tampil inisial nama.</div>
                    @error('photo') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                        value="{{ old('sort_order', $testimonial->sort_order) }}" required>
                    @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $testimonial->is_published))>
                        Tampilkan di beranda
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
