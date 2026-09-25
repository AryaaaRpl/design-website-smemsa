@extends('admin.layouts.app')

@section('title', 'Testimoni')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>Testimoni Alumni</h1>
            <p>Cerita sukses alumni di beranda (section Jejak Prestasi Siswa SMEMSA), tampil bergantian sesuai urutan.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Tambah Testimoni</a>
    </div>

    <div class="card">
        @if ($testimonials->isEmpty())
            <div class="empty-state">Belum ada testimoni.</div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Pekerjaan</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $testimonial)
                            <tr>
                                <td>{{ $testimonial->sort_order }}</td>
                                <td>
                                    @if ($testimonial->photo_url)
                                        <img src="{{ $testimonial->photo_url }}" alt="" class="thumb thumb-avatar">
                                    @else
                                        <span class="thumb thumb-avatar thumb-initials">{{ $testimonial->initials }}</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $testimonial->name }}</strong>
                                    <div class="text-muted" style="font-size: 13px;">
                                        {{ collect([$testimonial->major?->code, $testimonial->graduation_year ? 'Lulus '.$testimonial->graduation_year : null])->filter()->implode(' · ') ?: '-' }}
                                    </div>
                                </td>
                                <td>{{ $testimonial->job_title ?: '-' }}</td>
                                <td>
                                    <span class="status {{ $testimonial->is_published ? 'status-on' : 'status-off' }}">
                                        {{ $testimonial->is_published ? 'Tampil' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                            data-confirm="Hapus testimoni &quot;{{ $testimonial->name }}&quot;?">
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
