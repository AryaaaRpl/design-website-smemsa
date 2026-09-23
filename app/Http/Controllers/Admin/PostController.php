<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Enums\PostStatus;
use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostController extends Controller
{
    use HandlesUploads;

    public function index(Request $request): View
    {
        $status = PostStatus::tryFrom((string) $request->query('status'));
        $search = trim((string) $request->query('search'));

        $posts = Post::query()
            ->with('category')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($search !== '', fn ($query) => $query->where('title', 'like', "%{$search}%"))
            ->latest('published_at')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', [
            'posts' => $posts,
            'statuses' => PostStatus::cases(),
            'activeStatus' => $status,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return $this->form('admin.posts.create', new Post(['status' => PostStatus::Draft]));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request);
        $data['user_id'] = $request->user()->id;
        $data['thumbnail'] = $this->storeUpload($request->file('thumbnail'), 'posts');

        $previousHeadline = $this->savePost(new Post, $data);

        return redirect()->route('admin.posts.index')
            ->with('success', $this->successMessage('Berita berhasil ditambahkan.', $previousHeadline));
    }

    public function edit(Post $post): View
    {
        return $this->form('admin.posts.edit', $post);
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $this->prepareData($request);

        if ($request->hasFile('thumbnail')) {
            $this->deleteUpload($post->thumbnail);
            $data['thumbnail'] = $this->storeUpload($request->file('thumbnail'), 'posts');
        }

        $previousHeadline = $this->savePost($post, $data);

        return redirect()->route('admin.posts.index')
            ->with('success', $this->successMessage('Berita berhasil diperbarui.', $previousHeadline));
    }

    public function destroy(Post $post): RedirectResponse
    {
        // Soft delete: data masih ada di database, gambar tetap disimpan.
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dihapus.');
    }

    private function form(string $view, Post $post): View
    {
        return view($view, [
            'post' => $post,
            'categories' => Category::ofType(CategoryType::Post)->orderBy('name')->get(),
            'statuses' => PostStatus::cases(),
            // Headline yang sedang aktif (selain berita ini), untuk peringatan di form.
            'currentHeadline' => Post::headline()
                ->when($post->exists, fn ($query) => $query->whereKeyNot($post->id))
                ->first(),
        ]);
    }

    /**
     * Simpan berita. Jika berita ini dijadikan headline, headline lama dilepas
     * dalam transaksi yang sama agar headline selalu hanya satu.
     *
     * @return Post|null Headline lama yang digantikan.
     */
    private function savePost(Post $post, array $data): ?Post
    {
        return DB::transaction(function () use ($post, $data) {
            $previousHeadline = null;

            if ($data['is_featured']) {
                $otherHeadlines = Post::headline()
                    ->when($post->exists, fn ($query) => $query->whereKeyNot($post->id));

                $previousHeadline = (clone $otherHeadlines)->lockForUpdate()->first();
                $otherHeadlines->update(['is_featured' => false]);
            }

            $post->fill($data)->save();

            return $previousHeadline;
        });
    }

    private function successMessage(string $message, ?Post $previousHeadline): string
    {
        if (! $previousHeadline) {
            return $message;
        }

        return "{$message} Berita \"{$previousHeadline->title}\" tidak lagi menjadi headline utama.";
    }

    /**
     * Berita yang diterbitkan tanpa tanggal otomatis memakai waktu sekarang.
     */
    private function prepareData(PostRequest $request): array
    {
        $data = $request->safe()->except('thumbnail');

        if ($data['status'] === PostStatus::Published->value && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
