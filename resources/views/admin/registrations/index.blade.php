@extends('admin.layouts.app')

@section('title', 'Pendaftar SPMB')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Pendaftar SPMB</h1>
            <p>Status di sini tampil di menu Pengumuman pada akun pendaftar. Buka Detail untuk melihat data, berkas, buka kunci, dan reset kata sandi.</p>
        </div>
        <a href="{{ route('admin.registrations.create') }}" class="btn btn-primary">+ Tambah Pendaftar</a>
    </div>

    <div class="toolbar">
        <div class="filter-tabs">
            <a href="{{ route('admin.registrations.index', ['search' => $search ?: null]) }}"
                class="filter-tab {{ $activeStatus ? '' : 'active' }}">Semua</a>
            @foreach ($statuses as $status)
                <a href="{{ route('admin.registrations.index', ['status' => $status->value, 'search' => $search ?: null]) }}"
                    class="filter-tab {{ $activeStatus === $status ? 'active' : '' }}">
                    {{ $status->label() }} ({{ $statusCounts[$status->value] ?? 0 }})
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.registrations.index') }}" class="search-form">
            <input type="hidden" name="status" value="{{ $activeStatus?->value }}">
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari nomor, nama, asal sekolah...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($registrations->isEmpty())
            <div class="empty-state">
                {{ $search || $activeStatus ? 'Tidak ada pendaftar yang cocok.' : 'Belum ada pendaftar.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomor Pendaftaran</th>
                            <th>Pendaftar</th>
                            <th>Jurusan & Jalur</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $registration)
                            <tr>
                                <td>
                                    <strong>{{ $registration->registration_number }}</strong>
                                    <div class="text-muted" style="font-size: 13px;">{{ $registration->created_at->translatedFormat('d M Y') }}</div>
                                </td>
                                <td>
                                    {{ $registration->name }}
                                    <div class="text-muted" style="font-size: 13px;">
                                        Lahir {{ $registration->birth_date->translatedFormat('d M Y') }}{{ $registration->school_origin ? ' · '.$registration->school_origin : '' }}
                                    </div>
                                </td>
                                <td>
                                    {{ $registration->major?->code ?? '-' }}
                                    <div class="text-muted" style="font-size: 13px;">{{ $registration->pathway ?? '-' }}</div>
                                </td>
                                <td>
                                    <span class="status status-{{ $registration->status->tone() }}">{{ $registration->status->label() }}</span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        @if ($registration->phone)
                                            <a href="https://wa.me/{{ $registration->phone }}" target="_blank" rel="noopener" class="btn btn-outline btn-sm">Chat WA</a>
                                        @endif
                                        <a href="{{ route('admin.registrations.show', $registration) }}" class="btn btn-outline btn-sm">Detail</a>
                                        <a href="{{ route('admin.registrations.edit', $registration) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" novalidate action="{{ route('admin.registrations.destroy', $registration) }}"
                                            data-confirm="Hapus pendaftar {{ $registration->registration_number }} ({{ $registration->name }})?">
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

    {{ $registrations->links('admin.partials.pagination') }}
@endsection
