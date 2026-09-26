@php
    // Array keunggulan menjadi teks "satu baris satu keunggulan" untuk textarea.
    $featureLines = implode("\n", (array) old('features', $unit->features ?? []));
@endphp

@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: isi --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Data Unit Usaha</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label">Nama Unit Usaha <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $unit->name) }}"
                        placeholder="SMEMSA Print Studio" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $unit->slug) }}">
                    <div class="form-help">Kosongkan agar dibuat otomatis dari nama.</div>
                    @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="tagline" class="form-label">Bidang Usaha</label>
                    <input type="text" id="tagline" name="tagline" class="form-input" value="{{ old('tagline', $unit->tagline) }}"
                        placeholder="Percetakan & Merchandise">
                    <div class="form-help">Judul singkat di kartu beranda.</div>
                    @error('tagline') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="form-label">Ringkasan</label>
                    <textarea id="summary" name="summary" class="form-input" rows="3">{{ old('summary', $unit->summary) }}</textarea>
                    <div class="form-help">Tampil di kartu. Maks. 500 karakter.</div>
                    @error('summary') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi Lengkap</label>
                    <textarea id="description" name="description" class="form-input" rows="7">{{ old('description', $unit->description) }}</textarea>
                    <div class="form-help">Tampil di halaman unit usaha. Pisahkan paragraf dengan satu baris kosong.</div>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="features" class="form-label">Keunggulan</label>
                    <textarea id="features" name="features" class="form-input" rows="3" placeholder="Cetak Satuan&#10;Hasil Presisi&#10;Order Digital">{{ $featureLines }}</textarea>
                    <div class="form-help">Satu keunggulan per baris (maks. 6, pendek). Tampil sebagai label kecil di kartu.</div>
                    @error('features') <div class="form-error">{{ $message }}</div> @enderror
                    @error('features.*') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: pengelola & tampilan --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Pengelola & Pesanan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="managed_by" class="form-label">Pengelola <span class="required">*</span></label>
                    <select id="managed_by" name="managed_by" class="form-input" required>
                        @foreach ($managers as $manager)
                            <option value="{{ $manager->value }}" @selected(old('managed_by', $unit->managed_by?->value) === $manager->value)>
                                {{ $manager->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('managed_by') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <span class="form-label">Jurusan Pengelola</span>
                    <div class="checkbox-list">
                        @foreach ($majors as $major)
                            <label class="form-check">
                                <input type="checkbox" name="majors[]" value="{{ $major->id }}"
                                    @checked(in_array($major->id, old('majors', $selectedMajors)))>
                                {{ $major->code }}
                            </label>
                        @endforeach
                    </div>
                    <div class="form-help">Produk unit ini ikut tampil di halaman jurusan yang dipilih.</div>
                    @error('majors.*') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="whatsapp" class="form-label">Nomor WhatsApp Pesanan <span class="required">*</span></label>
                    <input type="text" id="whatsapp" name="whatsapp" class="form-input" inputmode="tel"
                        value="{{ old('whatsapp', $unit->whatsapp) }}" placeholder="082241356668" required>
                    <div class="form-help">Pesanan dari website dikirim ke nomor ini. Boleh ditulis 0822..., otomatis diubah ke 62822...</div>
                    @error('whatsapp') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card form-card">
            <div class="card-header">Tampilan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="image" class="form-label">Foto</label>
                    @if ($unit->image_url)
                        <img src="{{ $unit->image_url }}" alt="Foto saat ini" class="thumb thumb-preview">
                    @endif
                    <input type="file" id="image" name="image" class="form-input" accept="image/*">
                    <div class="form-help">Tampil di kartu beranda & halaman unit usaha. PNG/JPG/WEBP, maks. 2 MB. Kosongkan jika tidak diganti.</div>
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                        value="{{ old('sort_order', $unit->sort_order) }}" required>
                    @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $unit->is_active))>
                        Tampilkan di website
                    </label>
                    <div class="form-help">Jika disembunyikan, semua produknya ikut tidak tampil.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.business-units.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
