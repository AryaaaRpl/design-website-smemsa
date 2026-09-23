@extends('admin.layouts.app')

@section('title', 'Mitra Industri')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Mitra Industri</h1>
            <p>Perusahaan mitra DUDIKA untuk BKK dan logo mitra di website.</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">+ Tambah Mitra</a>
    </div>

    <div class="toolbar">
        <div></div>
        <form method="GET" action="{{ route('admin.partners.index') }}" class="search-form">
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari nama mitra...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($partners->isEmpty())
            <div class="empty-state">
                {{ $search ? 'Tidak ada mitra yang cocok dengan pencarian.' : 'Belum ada mitra.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Logo</th>
                            <th>Nama Mitra</th>
                            <th>Lowongan Aktif</th>
                            <th>Logo di Website</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $partner)
                            <tr>
                                <td>{{ $partner->sort_order }}</td>
                                <td>
                                    @if ($partner->logo_url)
                                        <img src="{{ $partner->logo_url }}" alt="Logo {{ $partner->name }}" class="thumb">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $partner->name }}</strong>
                                    @if ($partner->city || $partner->industry)
                                        <div class="text-muted" style="font-size: 13px;">
                                            {{ collect([$partner->industry, $partner->city])->filter()->implode(' · ') }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $partner->open_vacancies_count }} dari {{ $partner->job_vacancies_count }}</td>
                                <td>
                                    <span class="status {{ $partner->is_active ? 'status-on' : 'status-off' }}">
                                        {{ $partner->is_active ? 'Tampil' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.vacancies.create', ['partner' => $partner->id]) }}" class="btn btn-outline btn-sm">+ Lowongan</a>
                                        <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}"
                                            data-confirm="Hapus mitra &quot;{{ $partner->name }}&quot;?{{ $partner->job_vacancies_count ? ' '.$partner->job_vacancies_count.' lowongan milik mitra ini ikut terhapus.' : '' }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{ $partners->links('admin.partials.pagination') }}
@endsection
