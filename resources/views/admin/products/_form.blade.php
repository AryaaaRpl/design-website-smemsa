@php
    // Array menjadi teks "satu baris satu isi" untuk textarea.
    $variantLines = implode("\n", (array) old('variants', $product->variants ?? []));
    $specLines = collect(old('specs', $product->specs ?? []))
        ->map(fn ($spec) => is_array($spec) ? trim(($spec['label'] ?? '').': '.($spec['value'] ?? ''), ': ') : $spec)
        ->implode("\n");
@endphp

@if ($errors->any())
    <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
@endif

<div class="form-layout">
    {{-- Kolom kiri: isi --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Data Produk</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="business_unit_id" class="form-label">Unit Usaha <span class="required">*</span></label>
                    <select id="business_unit_id" name="business_unit_id" class="form-input" required>
                        <option value="">Pilih unit usaha</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" @selected((int) old('business_unit_id', $product->business_unit_id) === $unit->id)>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('business_unit_id') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Nama Produk <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $product->name) }}"
                        placeholder="Eners Perfume" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-input" value="{{ old('slug', $product->slug) }}">
                    <div class="form-help">Kosongkan agar dibuat otomatis dari nama.</div>
                    @error('slug') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="tagline" class="form-label">Subjudul</label>
                    <input type="text" id="tagline" name="tagline" class="form-input" value="{{ old('tagline', $product->tagline) }}"
                        placeholder="Parfum Badan Premium">
                    @error('tagline') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="form-label">Ringkasan</label>
                    <textarea id="summary" name="summary" class="form-input" rows="3">{{ old('summary', $product->summary) }}</textarea>
                    <div class="form-help">Tampil di kartu produk. Maks. 500 karakter.</div>
                    @error('summary') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Deskripsi Lengkap</label>
                    <textarea id="description" name="description" class="form-input" rows="7">{{ old('description', $product->description) }}</textarea>
                    <div class="form-help">Tampil di halaman detail. Pisahkan paragraf dengan satu baris kosong.</div>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="variants" class="form-label">Varian</label>
                    <textarea id="variants" name="variants" class="form-input" rows="3" placeholder="Bubblegum&#10;Baccarat">{{ $variantLines }}</textarea>
                    <div class="form-help">Satu varian per baris. Jika diisi, pemesan wajib memilih varian. Kosongkan jika tidak ada.</div>
                    @error('variants') <div class="form-error">{{ $message }}</div> @enderror
                    @error('variants.*') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="specs" class="form-label">Spesifikasi</label>
                    <textarea id="specs" name="specs" class="form-input" rows="4" placeholder="Kemasan: Eau de Parfum 35 mL&#10;Garansi: 30 hari">{{ $specLines }}</textarea>
                    <div class="form-help">Satu spesifikasi per baris dengan format <strong>Label: Isi</strong>.</div>
                    @error('specs') <div class="form-error">{{ $message }}</div> @enderror
                    @foreach ($errors->get('specs.*') as $messages)
                        <div class="form-error">{{ $messages[0] }}</div>
                        @break
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom kanan: harga, stok & tampilan --}}
    <div>
        <div class="card form-card">
            <div class="card-header">Harga & Stok</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="type" class="form-label">Jenis <span class="required">*</span></label>
                    <select id="type" name="type" class="form-input" required>
                        @foreach ($types as $type)
                            <option value="{{ $type->value }}" @selected(old('type', $product->type?->value) === $type->value)>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('type') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Harga (Rp) <span class="required">*</span></label>
                    <input type="text" id="price" name="price" class="form-input" inputmode="numeric"
                        value="{{ old('price', $product->price) }}" placeholder="35000" required>
                    <div class="form-help">Hanya tampil di halaman detail produk.</div>
                    @error('price') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="price_unit" class="form-label">Satuan Harga</label>
                    <input type="text" id="price_unit" name="price_unit" class="form-input"
                        value="{{ old('price_unit', $product->price_unit) }}" placeholder="botol / kg / unit">
                    <div class="form-help">Contoh tampilan: Rp 35.000 / botol.</div>
                    @error('price_unit') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="stock" class="form-label">Stok</label>
                    <input type="number" id="stock" name="stock" class="form-input" min="0"
                        value="{{ old('stock', $product->stock) }}">
                    <div class="form-help">
                        Hanya untuk jenis <strong>Barang</strong>. Kosongkan jika stok tidak dihitung.
                        Stok berkurang saat pesanan diubah ke "Diproses".
                    </div>
                    @error('stock') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card form-card">
            <div class="card-header">Tampilan</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="image" class="form-label">Foto</label>
                    @if ($product->image_url)
                        <img src="{{ $product->image_url }}" alt="Foto saat ini" class="thumb thumb-preview">
                    @endif
                    <input type="file" id="image" name="image" class="form-input" accept="image/*">
                    <div class="form-help">PNG/JPG/WEBP, maks. 2 MB. Kosongkan jika tidak diganti.</div>
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">Urutan Tampil <span class="required">*</span></label>
                    <input type="number" id="sort_order" name="sort_order" class="form-input" min="0"
                        value="{{ old('sort_order', $product->sort_order) }}" required>
                    @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))>
                        Unggulan (tampil di beranda)
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active))>
                        Tampilkan di website
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</div>
