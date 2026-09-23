@extends('admin.layouts.app')

@section('title', 'Lowongan Kerja')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Lowongan Kerja</h1>
            <p>Lowongan otomatis hilang dari website setelah melewati batas lamaran.</p>
        </div>
        <a href="{{ route('admin.vacancies.create') }}" class="btn btn-primary">+ Tambah Lowongan</a>
    </div>

    @if ($expiredCount > 0 && $activeFilter !== 'expired')
        <div class="alert">
            Ada <strong>{{ $expiredCount }} lowongan kedaluwarsa</strong> yang sudah tidak tampil di website.
            <a href="{{ route('admin.vacancies.index', ['filter' => 'expired']) }}" style="color: var(--blue); font-weight: 600;">Lihat &rarr;</a>
        </div>
    @endif

    <div class="toolbar">
        <div class="filter-tabs">
            @foreach ($filters as $key => $label)
                <a href="{{ route('admin.vacancies.index', ['filter' => $key, 'search' => $search ?: null]) }}"
                    class="filter-tab {{ $activeFilter === $key ? 'active' : '' }}">{{ $label }}</a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.vacancies.index') }}" class="search-form">
            <input type="hidden" name="filter" value="{{ $activeFilter }}">
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari posisi atau mitra...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($vacancies->isEmpty())
            <div class="empty-state">
                {{ $search ? 'Tidak ada lowongan yang cocok dengan pencarian.' : 'Tidak ada lowongan di daftar ini.' }}
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Posisi</th>
                            <th>Mitra</th>
                            <th>Tipe</th>
                            <th>Batas Lamaran</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vacancies as $vacancy)
                            <tr>
                                <td><strong>{{ $vacancy->position }}</strong></td>
                                <td>{{ $vacancy->partner?->name }}</td>
                                <td>{{ $vacancy->employment_type->label() }}</td>
                                <td>{{ $vacancy->deadline_label }}</td>
                                <td>
                                    <span class="status {{ $vacancy->display_status === 'Dibuka' ? 'status-on' : 'status-off' }}">
                                        {{ $vacancy->display_status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.vacancies.edit', $vacancy) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.vacancies.destroy', $vacancy) }}"
                                            data-confirm="Hapus lowongan &quot;{{ $vacancy->position }}&quot;?">
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

    {{ $vacancies->links('admin.partials.pagination') }}
@endsection
