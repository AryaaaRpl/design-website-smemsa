<?php

namespace App\Http\Controllers;

use App\Enums\BusinessManager;
use App\Models\BusinessUnit;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Halaman publik BLUD: katalog produk, profil unit usaha, detail produk (pesan lewat WhatsApp).
 */
class BludController extends Controller
{
    public function index(Request $request): View
    {
        $units = BusinessUnit::active()
            ->with('majors')
            ->withCount(['products' => fn ($query) => $query->where('is_active', true)])
            ->ordered()
            ->get();

        $activeUnit = $units->firstWhere('slug', $request->query('unit'));
        $studentUnitsCount = $units->where('managed_by', BusinessManager::Student)->count();

        // Semua produk dikirim sekaligus; filter unit dilakukan di browser tanpa memuat ulang halaman.
        $products = Product::visible()
            ->with('businessUnit.majors')
            ->ordered()
            ->get();

        return view('blud.index', compact('units', 'activeUnit', 'studentUnitsCount', 'products'));
    }

    public function unit(BusinessUnit $businessUnit): View
    {
        abort_unless($businessUnit->is_active, 404);

        $businessUnit->load([
            'majors',
            'products' => fn ($query) => $query->where('is_active', true)->ordered(),
        ]);

        // Kartu produk membaca unit usahanya; pakai objek yang sudah ada agar tidak query ulang.
        $businessUnit->products->each->setRelation('businessUnit', $businessUnit);

        return view('blud.unit', ['unit' => $businessUnit]);
    }

    public function show(Product $product): View
    {
        $product->load('businessUnit.majors');

        abort_unless($product->is_active && $product->businessUnit->is_active, 404);

        $relatedProducts = Product::visible()
            ->with('businessUnit')
            ->where('business_unit_id', $product->business_unit_id)
            ->whereKeyNot($product->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('blud.show', compact('product', 'relatedProducts'));
    }
}
