@extends('admin.layouts.app')

@section('title', 'Ekstrakurikuler')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Ekstrakurikuler</h1>
            <p>Kegiatan ekstrakurikuler yang tampil di halaman ekstrakurikuler, sesuai urutan.</p>
        </div>
        <a href="{{ route('admin.extracurriculars.create') }}" class="btn btn-primary">+ Tambah Ekstrakurikuler</a>
    </div>

    <div class="card">
        @if ($extracurriculars->isEmpty())
            <div class="empty-state">Belum ada data ekstrakurikuler.</div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jadwal</th>
                            <th>Kartu</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($extracurriculars as $extracurricular)
                            <tr>
                                <td>{{ $extracurricular->sort_order }}</td>
                                <td>
                                    @if ($extracurricular->image_url)
                                        <img src="{{ $extracurricular->image_url }}" alt="" class="thumb thumb-cover">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $extracurricular->name }}</strong>
                                    @if ($extracurricular->tag)
                                        <div class="text-muted" style="font-size: 13px;">{{ $extracurricular->tag }}</div>
                                    @endif
                                </td>
                                <td>{{ $extracurricular->schedule ?? '-' }}</td>
                                <td>{{ $extracurricular->card_style->label() }}</td>
                                <td>
                                    <span class="status {{ $extracurricular->is_active ? 'status-on' : 'status-off' }}">
                                        {{ $extracurricular->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.extracurriculars.edit', $extracurricular) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.extracurriculars.destroy', $extracurricular) }}"
                                            data-confirm="Hapus ekstrakurikuler &quot;{{ $extracurricular->name }}&quot;?">
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
