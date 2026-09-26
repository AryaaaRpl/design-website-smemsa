@extends('admin.layouts.app')

@section('title', 'Pesanan BLUD')

@section('content')
    <div class="page-header">
        <h1>Pesanan BLUD</h1>
        <p>Pesanan dari halaman detail produk. Hubungi pemesan lewat WhatsApp, lalu ubah statusnya.</p>
    </div>

    @error('status')
        <div class="alert">{{ $message }}</div>
    @enderror

    <div class="toolbar">
        <div class="filter-tabs">
            <a href="{{ route('admin.orders.index', ['unit' => $unitId, 'search' => $search ?: null]) }}"
                class="filter-tab {{ $activeStatus ? '' : 'active' }}">Semua</a>
            @foreach ($statuses as $status)
                <a href="{{ route('admin.orders.index', ['status' => $status->value, 'unit' => $unitId, 'search' => $search ?: null]) }}"
                    class="filter-tab {{ $activeStatus === $status ? 'active' : '' }}">
                    {{ $status->label() }} ({{ $statusCounts[$status->value] ?? 0 }})
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.orders.index') }}" class="search-form">
            <input type="hidden" name="status" value="{{ $activeStatus?->value }}">
            <select name="unit" class="form-input" onchange="this.form.submit()">
                <option value="">Semua unit usaha</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" @selected($unitId === $unit->id)>{{ $unit->name }}</option>
                @endforeach
            </select>
            <input type="search" name="search" class="form-input" value="{{ $search }}" placeholder="Cari kode, nama, produk...">
            <button type="submit" class="btn btn-outline">Cari</button>
        </form>
    </div>

    <div class="card">
        @if ($orders->isEmpty())
            <div class="empty-state">Belum ada pesanan.</div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pesanan</th>
                            <th>Pemesan</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <strong>{{ $order->code }}</strong>
                                    <div class="text-muted" style="font-size: 13px;">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</div>
                                </td>
                                <td>
                                    {{ $order->customer_name }}
                                    <div class="text-muted" style="font-size: 13px;">{{ $order->customer_phone }}</div>
                                </td>
                                <td>
                                    {{ $order->product_name }}{{ $order->variant ? ' ('.$order->variant.')' : '' }} &times; {{ $order->quantity }}
                                    <div class="text-muted" style="font-size: 13px;">{{ $order->businessUnit?->name ?? 'Unit usaha dihapus' }}</div>
                                    @if ($order->note)
                                        <div class="text-muted" style="font-size: 13px;">Catatan: {{ $order->note }}</div>
                                    @endif
                                </td>
                                <td>{{ $order->total_label }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-input" onchange="this.form.submit()"
                                            aria-label="Status pesanan {{ $order->code }}">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->value }}" @selected($order->status === $status)>{{ $status->label() }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ $order->customerWhatsappLink() }}" target="_blank" rel="noopener" class="btn btn-outline btn-sm">Chat WA</a>
                                        <form method="POST" action="{{ route('admin.orders.destroy', $order) }}"
                                            data-confirm="Hapus pesanan {{ $order->code }}?">
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

    {{ $orders->links('admin.partials.pagination') }}
@endsection
