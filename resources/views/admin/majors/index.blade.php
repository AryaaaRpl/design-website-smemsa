@extends('admin.layouts.app')

@section('title', 'Jurusan')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Konsentrasi Keahlian</h1>
            <p>Data jurusan yang tampil di halaman beranda.</p>
        </div>
        <a href="{{ route('admin.majors.create') }}" class="btn btn-primary">+ Tambah Jurusan</a>
    </div>

    <div class="card">
        @if ($majors->isEmpty())
            <div class="empty-state">Belum ada data jurusan.</div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Logo</th>
                            <th>Kode</th>
                            <th>Nama Jurusan</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($majors as $major)
                            <tr>
                                <td>{{ $major->sort_order }}</td>
                                <td>
                                    @if ($major->logo_url)
                                        <img src="{{ $major->logo_url }}" alt="Logo {{ $major->code }}" class="thumb">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td><strong>{{ $major->code }}</strong></td>
                                <td>{{ $major->name }}</td>
                                <td>
                                    <span class="status {{ $major->is_active ? 'status-on' : 'status-off' }}">
                                        {{ $major->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.majors.edit', $major) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.majors.destroy', $major) }}"
                                            data-confirm="Hapus jurusan {{ $major->code }}?">
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
