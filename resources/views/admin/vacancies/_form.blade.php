@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: isi lowongan --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Informasi Lowongan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="partner_id" class="form-label">Perusahaan Mitra <span class="required">*</span></label>
                    <select id="partner_id" name="partner_id" class="form-input" required>
                        <option value="">Pilih mitra</option>
                        @foreach ($partners as $partner)
                            <option value="{{ $partner->id }}" @selected((string) old('partner_id', $vacancy->partner_id) === (string) $partner->id)>
                                {{ $partner->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help">Mitra belum ada? <a href="{{ route('admin.partners.create') }}" style="color: var(--blue); font-weight: 600;">Tambah mitra dulu</a>.</div>
                    @error('partner_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="position" class="form-label">Posisi Pekerjaan <span class="required">*</span></label>
                    <input type="text" id="position" name="position" class="form-input"
                        value="{{ old('position', $vacancy->position) }}" placeholder="Junior Web Developer" required>
                    @error('position') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $vacancy->slug) }}">
                    <div class="form-help">Kosongkan agar dibuat otomatis dari posisi.</div>
                    @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">Lokasi Penempatan</label>
                    <input type="text" id="location" name="location" class="form-input"
                        value="{{ old('location', $vacancy->location) }}" placeholder="Surabaya / Banyuwangi">
                    @error('location') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" name="description" class="form-input" rows="4">{{ old('description', $vacancy->description) }}</textarea>
                    <div class="form-help">Catatan internal, belum tampil di website.</div>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="requirements" class="form-label">Persyaratan</label>
                    <textarea id="requirements" name="requirements" class="form-input" rows="4">{{ old('requirements', $vacancy->requirements) }}</textarea>
                    <div class="form-help">Catatan internal, belum tampil di website.</div>
                    @error('requirements') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: status --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Status & Lamaran</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="employment_type" class="form-label">Tipe <span class="required">*</span></label>
                    <select id="employment_type" name="employment_type" class="form-input" required>
                        @foreach ($employmentTypes as $type)
                            <option value="{{ $type->value }}" @selected(old('employment_type', $vacancy->employment_type?->value) === $type->value)>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('employment_type') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status <span class="required">*</span></label>
                    <select id="status" name="status" class="form-input" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" @selected(old('status', $vacancy->status?->value) === $status->value)>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help">Pilih Ditutup untuk menyembunyikan lowongan sebelum batas lamaran.</div>
                    @error('status') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="closes_at" class="form-label">Batas Lamaran</label>
                    <input type="date" id="closes_at" name="closes_at" class="form-input"
                        value="{{ old('closes_at', $vacancy->closes_at?->format('Y-m-d')) }}">
                    <div class="form-help">Setelah tanggal ini lowongan otomatis hilang dari website. Kosongkan jika tanpa batas.</div>
                    @error('closes_at') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="apply_url" class="form-label">Link Lamaran</label>
                    <input type="url" id="apply_url" name="apply_url" class="form-input"
                        value="{{ old('apply_url', $vacancy->apply_url) }}" placeholder="https://...">
                    <div class="form-help">Kosongkan agar tombol "Lamar Loker" membuka WhatsApp BKK.</div>
                    @error('apply_url') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.vacancies.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
