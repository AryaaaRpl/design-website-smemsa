<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(string $group = 'identity'): View
    {
        abort_unless(isset(SiteSettings::GROUPS[$group]), 404);

        return view('admin.settings.edit', [
            'groups' => SiteSettings::GROUPS,
            'activeGroup' => $group,
            'fields' => SiteSettings::GROUPS[$group]['fields'],
            'values' => Setting::allValues(),
        ]);
    }

    public function update(Request $request, string $group): RedirectResponse
    {
        abort_unless(isset(SiteSettings::GROUPS[$group]), 404);

        $fields = SiteSettings::GROUPS[$group]['fields'];

        // Nomor WhatsApp dirapikan dulu (0822... menjadi 62822...) sebelum divalidasi.
        foreach ($fields as $key => $field) {
            if ($field['type'] === 'whatsapp') {
                $request->merge([$key => SiteSettings::normalizeWhatsapp($request->input($key))]);
            }
        }

        $data = $request->validate(
            collect($fields)->map(fn (array $field) => $field['rules'])->all(),
            [
                'regex' => 'Format :attribute tidak valid.',
                'maps_embed_url.starts_with' => 'Link embed harus diawali https://www.google.com/maps/embed',
            ],
            collect($fields)->map(fn (array $field) => $field['label'])->all(),
        );

        foreach ($fields as $key => $field) {
            // Kosong disimpan sebagai null: website otomatis memakai nilai bawaan.
            Setting::setValue($key, filled($data[$key] ?? null) ? trim((string) $data[$key]) : null);
        }

        return redirect()
            ->route('admin.settings.edit', $group)
            ->with('success', 'Pengaturan '.SiteSettings::GROUPS[$group]['label'].' berhasil disimpan.');
    }
}
