<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    use HandlesUploads;

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
            // Gambar: hanya diganti bila ada file baru (yang lama dihapus). Disimpan WebP + varian -card.webp.
            if ($field['type'] === 'image') {
                if ($request->hasFile($key)) {
                    $this->deleteUpload(Setting::getValue($key));
                    Setting::setValue($key, $this->storeUpload($request->file($key), 'settings'));
                }

                continue;
            }

            // Kolom opsional yang dikosongkan disimpan null (misal sosial media tidak ditampilkan).
            Setting::setValue($key, filled($data[$key] ?? null) ? trim((string) $data[$key]) : null);
        }

        return redirect()
            ->route('admin.settings.edit', $group)
            ->with('success', 'Pengaturan '.SiteSettings::GROUPS[$group]['label'].' berhasil disimpan.');
    }
}
