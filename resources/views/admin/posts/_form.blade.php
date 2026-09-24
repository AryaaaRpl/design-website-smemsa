@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: isi berita --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Isi Berita</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title" class="form-label">Judul <span class="required">*</span></label>
                    <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $post->title) }}" required>
                    @error('title') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $post->slug) }}">
                    <div class="form-help">Kosongkan agar dibuat otomatis dari judul.</div>
                    @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="excerpt" class="form-label">Ringkasan</label>
                    <textarea id="excerpt" name="excerpt" class="form-input" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
                    <div class="form-help">Tampil di kartu berita. Maks. 500 karakter.</div>
                    @error('excerpt') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="body" class="form-label">Isi Berita <span class="required">*</span></label>
                    <textarea id="body" name="body" class="form-input" rows="12" required>{{ old('body', $post->body) }}</textarea>
                    <div class="form-help">Pisahkan paragraf dengan satu baris kosong.</div>
                    @error('body') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: pengaturan --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Publikasi</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="status" class="form-label">Status <span class="required">*</span></label>
                    <select id="status" name="status" class="form-input" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" @selected(old('status', $post->status?->value) === $status->value)>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="published_at" class="form-label">Tanggal Terbit</label>
                    <input type="datetime-local" id="published_at" name="published_at" class="form-input"
                        value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
                    <div class="form-help">Kosongkan untuk memakai waktu saat diterbitkan.</div>
                    @error('published_at') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured))
                            @if ($currentHeadline) data-toggle-target="headline-warning" @endif>
                        Jadikan headline utama
                    </label>
                    <div class="form-help">
                        Hanya untuk berita berstatus Terbit.
                        @if ($currentHeadline)
                            Headline saat ini: <strong>{{ $currentHeadline->title }}</strong>
                        @endif
                    </div>
                    @if ($currentHeadline)
                        <div class="alert alert-inline" id="headline-warning" @unless (old('is_featured', $post->is_featured)) hidden @endunless>
                            Berita "{{ $currentHeadline->title }}" tidak lagi menjadi headline utama setelah berita ini disimpan.
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
                    <label for="category_id" class="form-label">Kategori</label>
                    <select id="category_id" name="category_id" class="form-input">
                        <option value="">Tanpa kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('category_id', $post->category_id) === (string) $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" id="location" name="location" class="form-input"
                        value="{{ old('location', $post->location) }}" placeholder="Sekolah MUHI">
                    @error('location') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="byline" class="form-label">Penulis</label>
                    <input type="text" id="byline" name="byline" class="form-input"
                        value="{{ old('byline', $post->byline) }}" placeholder="Tim Jurnalistik">
                    @error('byline') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="thumbnail" class="form-label">Gambar</label>
                    @if ($post->thumbnail_url)
                        <img src="{{ $post->thumbnail_url }}" alt="Gambar saat ini" class="thumb-wide">
                    @endif
                    <input type="file" id="thumbnail" name="thumbnail" class="form-input" accept="image/*">
                    <div class="form-help">JPG/PNG/WEBP, maks. 2 MB. Kosongkan jika tidak diganti.</div>
                    @error('thumbnail') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
