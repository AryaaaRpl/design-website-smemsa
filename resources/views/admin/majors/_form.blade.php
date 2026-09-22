@php
    // Ubah array menjadi teks "satu baris satu poin" untuk textarea.
    $lines = fn (string $field) => implode("\n", (array) old($field, $major->{$field} ?? []));
@endphp

@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="card form-card">
    <div class="card-header">Identitas Jurusan</div>
    <div class="card-body form-grid">
        <div class="form-group">
            <label for="code" class="form-label">Kode <span class="required">*</span></label>
            <input type="text" id="code" name="code" class="form-input" value="{{ old('code', $major->code) }}"
                placeholder="PPLG" required>
            @error('code') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="name" class="form-label">Nama Jurusan <span class="required">*</span></label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $major->name) }}"
                placeholder="Pengembang Perangkat Lunak & Gim" required>
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $major->slug) }}"
                placeholder="rpl">
            <div class="form-help">Kosongkan agar dibuat otomatis dari nama. Dipakai tombol pintasan jurusan di beranda.</div>
            @error('slug') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
            <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                value="{{ old('sort_order', $major->sort_order) }}" required>
            @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group form-full">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea id="description" name="description" class="form-input" rows="3">{{ old('description', $major->description) }}</textarea>
            @error('description') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="tefa_name" class="form-label">Nama TEFA</label>
            <input type="text" id="tefa_name" name="tefa_name" class="form-input"
                value="{{ old('tefa_name', $major->tefa_name) }}">
            @error('tefa_name') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="certification_summary" class="form-label">Ringkasan Sertifikasi</label>
            <input type="text" id="certification_summary" name="certification_summary" class="form-input"
                value="{{ old('certification_summary', $major->certification_summary) }}">
            @error('certification_summary') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="logo" class="form-label">Logo</label>
            @if ($major->logo_url)
                <img src="{{ $major->logo_url }}" alt="Logo saat ini" class="thumb thumb-preview">
            @endif
            <input type="file" id="logo" name="logo" class="form-input" accept="image/*">
            <div class="form-help">PNG/JPG/WEBP, maks. 2 MB. Kosongkan jika tidak diganti.</div>
            @error('logo') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="student_photo" class="form-label">Foto Siswa</label>
            @if ($major->student_photo_url)
                <img src="{{ $major->student_photo_url }}" alt="Foto saat ini" class="thumb thumb-preview">
            @endif
            <input type="file" id="student_photo" name="student_photo" class="form-input" accept="image/*">
            <div class="form-help">Disarankan PNG transparan rasio 3:4, maks. 2 MB.</div>
            @error('student_photo') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group form-full">
            <label class="form-check">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $major->is_active))>
                Tampilkan di website
            </label>
        </div>
    </div>
</div>

<div class="card form-card">
    <div class="card-header">Alur Pendidikan</div>
    <div class="card-body">
        <p class="form-help" style="margin-top: 0;">Untuk kolom daftar, tulis satu poin per baris.</p>

        <div class="form-group">
            <label for="competencies" class="form-label">1. Yang Dipelajari (Kompetensi)</label>
            <textarea id="competencies" name="competencies" class="form-input" rows="3">{{ $lines('competencies') }}</textarea>
            @error('competencies.*') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="practice_items" class="form-label">2. Tempat Praktik</label>
                <textarea id="practice_items" name="practice_items" class="form-input" rows="3">{{ $lines('practice_items') }}</textarea>
                @error('practice_items.*') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="practice_note" class="form-label">Catatan Tempat Praktik</label>
                <input type="text" id="practice_note" name="practice_note" class="form-input"
                    value="{{ old('practice_note', $major->practice_note) }}">
                @error('practice_note') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="certification_items" class="form-label">3. Sertifikasi</label>
                <textarea id="certification_items" name="certification_items" class="form-input" rows="3">{{ $lines('certification_items') }}</textarea>
                @error('certification_items.*') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="certification_note" class="form-label">Catatan Sertifikasi</label>
                <input type="text" id="certification_note" name="certification_note" class="form-input"
                    value="{{ old('certification_note', $major->certification_note) }}">
                @error('certification_note') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="career_items" class="form-label">4. Setelah Lulus</label>
                <textarea id="career_items" name="career_items" class="form-input" rows="3">{{ $lines('career_items') }}</textarea>
                @error('career_items.*') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="career_note" class="form-label">Catatan Setelah Lulus</label>
                <input type="text" id="career_note" name="career_note" class="form-input"
                    value="{{ old('career_note', $major->career_note) }}">
                @error('career_note') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.majors.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
