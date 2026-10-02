@extends('admin.layouts.app')

@section('title', 'Biaya & Beasiswa')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Skema Beasiswa</h1>
            <p>Tabel beasiswa di halaman SPMB. Nominal biaya seragam, PSM, PKL, dan UKK diatur di
                <a href="{{ route('admin.settings.edit', 'fees') }}">Pengaturan &rsaquo; Biaya SPMB</a>.</p>
        </div>
        <a href="{{ route('admin.scholarships.create') }}" class="btn btn-primary">+ Tambah Beasiswa</a>
    </div>

    <div class="card">
        @if ($scholarships->isEmpty())
            <div class="empty-state">Belum ada beasiswa.</div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Beasiswa</th>
                            <th>Masa Berlaku</th>
                            <th>Besaran</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scholarships as $scholarship)
                            <tr>
                                <td>{{ $scholarship->sort_order }}</td>
                                <td>
                                    <strong>{{ $scholarship->name }}</strong>
                                    <div class="text-muted" style="font-size: 13px;">{{ $scholarship->tag ?: '-' }}</div>
                                </td>
                                <td>{{ $scholarship->period }}</td>
                                <td>{{ $scholarship->amount }}</td>
                                <td>
                                    <span class="status {{ $scholarship->is_published ? 'status-on' : 'status-off' }}">
                                        {{ $scholarship->is_published ? 'Tampil' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.scholarships.edit', $scholarship) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.scholarships.destroy', $scholarship) }}"
                                            data-confirm="Hapus beasiswa &quot;{{ $scholarship->name }}&quot;?">
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
@endsection
