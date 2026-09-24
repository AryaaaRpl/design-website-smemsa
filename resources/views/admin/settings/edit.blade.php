@extends('admin.layouts.app')

@section('title', 'Pengaturan')

@section('content')
    <div class="page-header">
        <h1>Pengaturan Situs</h1>
        <p>Data yang tampil di semua halaman website. Isian kosong otomatis memakai nilai bawaan (tertulis di contoh isian).</p>
    </div>

    <div class="filter-tabs">
        @foreach ($groups as $key => $group)
            <a href="{{ route('admin.settings.edit', $key) }}" class="filter-tab {{ $activeGroup === $key ? 'active' : '' }}">
                {{ $group['label'] }}
            </a>
        @endforeach
    </div>

    @if ($errors->any())
        <div class="alert">Periksa kembali isian form, masih ada data yang belum valid.</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update', $activeGroup) }}" class="form-narrow">
        @csrf
        @method('PUT')

        <div class="card form-card">
            <div class="card-header">{{ $groups[$activeGroup]['label'] }}</div>
            <div class="card-body">
                @foreach ($fields as $key => $field)
                    @php
                        $value = old($key, $values[$key] ?? null);
                        // Contoh isian = nilai bawaan (untuk WhatsApp BKK/SPMB: nomor umum).
                        $placeholder = $field['default'] ?? 'Kosong = memakai WhatsApp Umum';
                    @endphp
                    <div class="form-group">
                        <label for="{{ $key }}" class="form-label">{{ $field['label'] }}</label>

                        @if ($field['type'] === 'textarea')
                            <textarea id="{{ $key }}" name="{{ $key }}" class="form-input" rows="3"
                                placeholder="{{ $placeholder }}">{{ $value }}</textarea>
                        @else
                            <input type="{{ $field['type'] === 'number' ? 'number' : ($field['type'] === 'url' ? 'url' : 'text') }}"
                                id="{{ $key }}" name="{{ $key }}" class="form-input" value="{{ $value }}"
                                placeholder="{{ $placeholder }}" @if ($field['type'] === 'number') step="any" min="0" @endif>
                        @endif

                        <div class="form-help">
                            {{ $field['help'] }}
                            @if (blank($values[$key] ?? null) && $field['default'])
                                <br><strong>Sedang memakai nilai bawaan.</strong>
                            @endif
                        </div>
                        @error($key) <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan {{ $groups[$activeGroup]['label'] }}</button>
        </div>
    </form>
@endsection
