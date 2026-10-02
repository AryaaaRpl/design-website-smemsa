@extends('admin.layouts.app')

@section('title', 'FAQ SPMB')

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>FAQ SPMB</h1>
            <p>Pertanyaan Sering Diajukan di halaman SPMB, tampil sesuai urutan.</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">+ Tambah FAQ</a>
    </div>

    <div class="card">
        @if ($faqs->isEmpty())
            <div class="empty-state">Belum ada FAQ.</div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Pertanyaan</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                            <tr>
                                <td>{{ $faq->sort_order }}</td>
                                <td>
                                    <strong>{{ $faq->question }}</strong>
                                    <div class="text-muted" style="font-size: 13px;">{{ \Illuminate\Support\Str::limit($faq->answer, 90) }}</div>
                                </td>
                                <td>
                                    <span class="status {{ $faq->is_published ? 'status-on' : 'status-off' }}">
                                        {{ $faq->is_published ? 'Tampil' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}"
                                            data-confirm="Hapus FAQ &quot;{{ $faq->question }}&quot;?">
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
