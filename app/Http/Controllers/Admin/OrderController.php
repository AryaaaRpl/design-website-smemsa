<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Daftar pesanan BLUD dari website. Admin hanya mengubah status, isi pesanan tidak diedit.
 */
class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $activeStatus = OrderStatus::tryFrom((string) $request->query('status'));
        $unitId = $request->integer('unit') ?: null;
        $search = trim((string) $request->query('search'));

        $orders = Order::query()
            ->with('businessUnit')
            ->when($activeStatus, fn ($query) => $query->ofStatus($activeStatus))
            ->when($unitId, fn ($query) => $query->where('business_unit_id', $unitId))
            ->when($search !== '', fn ($query) => $query->where(fn ($query) => $query
                ->where('code', 'like', "%{$search}%")
                ->orWhere('customer_name', 'like', "%{$search}%")
                ->orWhere('product_name', 'like', "%{$search}%")))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $statusCounts = Order::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => OrderStatus::cases(),
            'statusCounts' => $statusCounts,
            'activeStatus' => $activeStatus,
            'units' => BusinessUnit::ordered()->get(),
            'unitId' => $unitId,
            'search' => $search,
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::enum(OrderStatus::class)],
        ]);

        $order->changeStatus(OrderStatus::from($validated['status']));

        return back()->with('success', "Status pesanan {$order->code} diubah menjadi {$order->status->label()}.");
    }

    public function destroy(Order $order): RedirectResponse
    {
        // Pesanan yang sudah memotong stok dikembalikan dulu stoknya.
        if ($order->stock_deducted) {
            $order->changeStatus(OrderStatus::Cancelled);
        }

        $order->delete();

        return back()->with('success', "Pesanan {$order->code} berhasil dihapus.");
    }
}
