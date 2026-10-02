@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: data calon siswa --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Data Calon Siswa</div>
            <div class="card-body">
                @if ($registration->exists)
                    <div class="form-group">
                        <span class="form-label">Nomor Pendaftaran</span>
                        <strong>{{ $registration->registration_number }}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $registration->name) }}" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="birth_date" class="form-label">Tanggal Lahir <span class="required">*</span></label>
                    <input type="date" id="birth_date" name="birth_date" class="form-input"
                        value="{{ old('birth_date', $registration->birth_date?->format('Y-m-d')) }}" required>
                                        @error('birth_date') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="school_origin" class="form-label">Asal Sekolah</label>
                    <input type="text" id="school_origin" name="school_origin" class="form-input"
                        value="{{ old('school_origin', $registration->school_origin) }}" placeholder="SMP Negeri 1 Genteng">
                    @error('school_origin') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Nomor WhatsApp</label>
                    <input type="text" id="phone" name="phone" class="form-input" inputmode="tel"
                        value="{{ old('phone', $registration->phone) }}" placeholder="082241356668">
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="major_id" class="form-label">Jurusan Pilihan</label>
                    <select id="major_id" name="major_id" class="form-input">
                        <option value="">- Belum memilih -</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}" @selected((int) old('major_id', $registration->major_id) === $major->id)>
                                {{ $major->code }} - {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('major_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="pathway" class="form-label">Jalur Pendaftaran</label>
                    <select id="pathway" name="pathway" class="form-input">
                        <option value="">-</option>
                        @foreach ($pathways as $pathway)
                            <option value="{{ $pathway }}" @selected(old('pathway', $registration->pathway) === $pathway)>{{ $pathway }}</option>
                        @endforeach
                    </select>
                    @error('pathway') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: status yang dilihat pendaftar di menu Pengumuman --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Status Pendaftaran</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="status" class="form-label">Status <span class="required">*</span></label>
                    <select id="status" name="status" class="form-input" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" @selected(old('status', $registration->status?->value) === $status->value)>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="note" class="form-label">Catatan untuk Calon Siswa</label>
                    <textarea id="note" name="note" class="form-input" rows="5"
                        placeholder="Contoh: Scan Kartu Keluarga buram, mohon unggah ulang.">{{ old('note', $registration->note) }}</textarea>
                    <div class="form-help">Tampil di menu Pengumuman pendaftar. Jangan tulis hal yang bersifat pribadi.</div>
                    @error('note') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
