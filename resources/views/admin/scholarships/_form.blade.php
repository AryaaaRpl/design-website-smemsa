@php use App\Models\Scholarship; @endphp

@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: isi beasiswa --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Beasiswa</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="form-label">Nama Beasiswa <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $scholarship->name) }}"
                        placeholder="Beasiswa Berprestasi" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Kriteria & Syarat Penerima <span class="required">*</span></label>
                    <textarea id="description" name="description" class="form-input" rows="4" maxlength="500" required>{{ old('description', $scholarship->description) }}</textarea>
                    <div class="form-help">Boleh menebalkan kata dengan &lt;strong&gt;kata&lt;/strong&gt; atau memiringkan dengan &lt;em&gt;kata&lt;/em&gt;.</div>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="period" class="form-label">Masa Berlaku <span class="required">*</span></label>
                        <input type="text" id="period" name="period" class="form-input" value="{{ old('period', $scholarship->period) }}"
                            placeholder="Berlaku 3 Tahun" required>
                        @error('period') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="amount" class="form-label">Besaran Keringanan <span class="required">*</span></label>
                        <input type="text" id="amount" name="amount" class="form-input" value="{{ old('amount', $scholarship->amount) }}"
                            placeholder="Potongan Rp 500.000" required>
                        @error('amount') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: tampilan --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Tampilan</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="tag" class="form-label">Label</label>
                        <input type="text" id="tag" name="tag" class="form-input" value="{{ old('tag', $scholarship->tag) }}" placeholder="Jalur Alumni">
                        @error('tag') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="tag_color" class="form-label">Warna Label <span class="required">*</span></label>
                        <select id="tag_color" name="tag_color" class="form-input" required>
                            @foreach (Scholarship::TAG_COLORS as $value => $label)
                                <option value="{{ $value }}" @selected(old('tag_color', $scholarship->tag_color) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('tag_color') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="tone" class="form-label">Gaya Baris <span class="required">*</span></label>
                    <select id="tone" name="tone" class="form-input" required>
                        @foreach (Scholarship::TONES as $value => $label)
                            <option value="{{ $value }}" @selected(old('tone', $scholarship->tone) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="form-help">Warna baris, nomor, masa berlaku, dan besaran di tabel.</div>
                    @error('tone') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                        value="{{ old('sort_order', $scholarship->sort_order) }}" required>
                    @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $scholarship->is_published))>
                        Tampilkan di halaman SPMB
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.scholarships.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
