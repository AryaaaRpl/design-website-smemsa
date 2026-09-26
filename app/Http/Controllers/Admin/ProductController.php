<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductType;
use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\BusinessUnit;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    use HandlesUploads;

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search'));
        $unitId = $request->integer('unit') ?: null;

        $products = Product::query()
            ->with('businessUnit')
            ->when($unitId, fn ($query) => $query->where('business_unit_id', $unitId))
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        $units = BusinessUnit::ordered()->get();

        return view('admin.products.index', compact('products', 'units', 'unitId', 'search'));
    }

    public function create(Request $request): View
    {
        $product = new Product([
            'business_unit_id' => $request->integer('unit') ?: null,
            'sort_order' => Product::max('sort_order') + 1,
            'is_active' => true,
        ]);

        return $this->form('admin.products.create', $product);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('image');
        $data['image'] = $this->storeUpload($request->file('image'), 'products');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return $this->form('admin.products.edit', $product);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $this->deleteUpload($product->image);
            $data['image'] = $this->storeUpload($request->file('image'), 'products');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        // Riwayat pesanan tetap disimpan (nama & harga produk sudah disalin ke pesanan).
        $this->deleteUpload($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function form(string $view, Product $product): View
    {
        return view($view, [
            'product' => $product,
            'units' => BusinessUnit::ordered()->get(),
            'types' => ProductType::cases(),
        ]);
    }
}
