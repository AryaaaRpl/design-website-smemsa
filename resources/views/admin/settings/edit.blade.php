@extends('admin.layouts.app')

@section('title', 'Pengaturan')

@section('content')
    <div class="page-header">
        <h1>Pengaturan Situs</h1>
        <p>Data yang tampil di semua halaman website. Kolom bertanda * wajib diisi.</p>
    </div>

    <div class="filter-tabs">
        @foreach ($groups as $key => $group)
            <a href="{{ route('admin.settings.edit', $key) }}" class="filter-tab {{ $activeGroup === $key ? 'active' : '' }}">
                {{ $group['label'] }}
            </a>
        @endforeach
    </div>

    @if ($errors->any())
        <div class="alert alert-error">Periksa kembali isian form, masih ada data yang belum valid.</div>
    @endif

    <form method="POST" novalidate action="{{ route('admin.settings.update', $activeGroup) }}" class="form-narrow" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card form-card">
            <div class="card-header">{{ $groups[$activeGroup]['label'] }}</div>
            <div class="card-body">
                @foreach ($fields as $key => $field)
                    @php
                        $value = old($key, $values[$key] ?? null);
                        $placeholder = $field['placeholder'] ?? '';
                        $required = in_array('required', $field['rules'], true);
                    @endphp
                    <div class="form-group">
                        <label for="{{ $key }}" class="form-label">{{ $field['label'] }} @if ($required)<span class="required">*</span>@endif</label>

                        @if ($field['type'] === 'textarea')
                            <textarea id="{{ $key }}" name="{{ $key }}" class="form-input" rows="3"
                                placeholder="{{ $placeholder }}">{{ $value }}</textarea>
                        @elseif ($field['type'] === 'image')
                            @if (filled($values[$key] ?? null))
                                <img src="{{ Storage::disk('public')->url($values[$key]) }}" alt="{{ $field['label'] }} saat ini"
                                    style="display:block; max-width:320px; width:100%; border-radius:8px; margin-bottom:0.6rem;">
                            @endif
                            <input type="file" id="{{ $key }}" name="{{ $key }}" class="form-input" accept="image/jpeg,image/png,image/webp">
                        @elseif ($field['type'] === 'money')
                            <div class="input-prefix">
                                <span>Rp</span>
                                <input type="number" id="{{ $key }}" name="{{ $key }}" class="form-input" value="{{ $value }}"
                                    placeholder="{{ $placeholder }}" step="1000" min="0">
                            </div>
                        @else
                            <input type="{{ $field['type'] === 'number' ? 'number' : ($field['type'] === 'url' ? 'url' : 'text') }}"
                                id="{{ $key }}" name="{{ $key }}" class="form-input" value="{{ $value }}"
                                placeholder="{{ $placeholder }}" @if ($field['type'] === 'number') step="any" min="0" @endif>
                        @endif

                        <div class="form-help">
                            {{ $field['help'] }}
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
