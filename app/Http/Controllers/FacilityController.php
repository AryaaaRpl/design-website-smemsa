<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function __invoke(): View
    {
        $facilities = Facility::with(['major', 'images'])->ordered()->get();

        // Titik denah, diberi nomor sesuai urutan (dipakai juga di Daftar Lengkap).
        $mapFacilities = $facilities->filter(fn (Facility $facility) => $facility->map_x !== null && $facility->map_y !== null)->values();

        $tefaList = $facilities->where('show_in_tefa_list', true)->values();
        $featuredFacilities = $facilities->where('is_featured', true)->values();

        // Data panel & modal untuk semua fasilitas, dikunci dengan slug.
        $facilityData = $facilities->mapWithKeys(fn (Facility $facility) => [$facility->slug => $facility->toPageArray()]);

        return view('fasilitas', compact('mapFacilities', 'tefaList', 'featuredFacilities', 'facilityData'));
    }
}
