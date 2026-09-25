<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Major;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    use HandlesUploads;

    public function index(): View
    {
        $testimonials = Testimonial::with('major')->ordered()->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        $testimonial = new Testimonial([
            'sort_order' => Testimonial::max('sort_order') + 1,
            'is_published' => true,
        ]);

        return $this->form('admin.testimonials.create', $testimonial);
    }

    public function store(TestimonialRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('photo');
        $data['photo'] = $this->storeUpload($request->file('photo'), 'testimonials');

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return $this->form('admin.testimonials.edit', $testimonial);
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->safe()->except('photo');

        if ($request->hasFile('photo')) {
            $this->deleteUpload($testimonial->photo);
            $data['photo'] = $this->storeUpload($request->file('photo'), 'testimonials');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $this->deleteUpload($testimonial->photo);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    private function form(string $view, Testimonial $testimonial): View
    {
        return view($view, [
            'testimonial' => $testimonial,
            'majors' => Major::ordered()->get(),
        ]);
    }
}
