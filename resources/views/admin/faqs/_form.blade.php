@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: pertanyaan & jawaban --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Pertanyaan & Jawaban</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="question" class="form-label">Pertanyaan <span class="required">*</span></label>
                    <input type="text" id="question" name="question" class="form-input" value="{{ old('question', $faq->question) }}"
                        placeholder="Bagaimana mekanisme cicilan biaya pendidikan?" required>
                    @error('question') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="answer" class="form-label">Jawaban <span class="required">*</span></label>
                    <textarea id="answer" name="answer" class="form-input" rows="6" maxlength="1000" required>{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-help">
                    Kode otomatis (bisa dipakai di pertanyaan & jawaban):
                    @foreach (\App\Models\Faq::PLACEHOLDERS as $code => $label)
                        <div><strong>{{ $code }}</strong> &mdash; {{ $label }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: tampilan --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Tampilan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                        value="{{ old('sort_order', $faq->sort_order) }}" required>
                    @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $faq->is_published))>
                        Tampilkan di halaman SPMB
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
