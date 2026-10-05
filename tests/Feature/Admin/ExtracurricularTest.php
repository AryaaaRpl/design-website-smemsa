<?php

namespace Tests\Feature\Admin;

use App\Models\Extracurricular;
use App\Models\User;
use App\Support\Media;
use Database\Seeders\ExtracurricularSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExtracurricularTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
    }

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Robotik Club',
            'tag' => 'Sains & Teknologi',
            'card_style' => 'normal',
            'sort_order' => 1,
            'is_active' => '1',
            'achievements' => "Juara 1 Robotik\n\nJuara 2 Line Follower\n",
        ], $overrides);
    }

    public function test_guest_cannot_access_extracurriculars(): void
    {
        $this->get(route('admin.extracurriculars.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_extracurricular(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.extracurriculars.store'), $this->validData())
            ->assertRedirect(route('admin.extracurriculars.index'));

        $ekskul = Extracurricular::firstWhere('slug', 'robotik-club');
        $this->assertSame(['Juara 1 Robotik', 'Juara 2 Line Follower'], $ekskul->achievements);
    }

    public function test_uploaded_photo_is_resized_to_webp(): void
    {
        if (! function_exists('imagewebp')) {
            $this->markTestSkipped('GD tanpa dukungan WebP.');
        }
        Storage::fake('public');

        $this->actingAs($this->admin)
            ->post(route('admin.extracurriculars.store'), $this->validData([
                'image' => UploadedFile::fake()->image('foto.jpg', 3200, 2400),
            ]));

        $path = Extracurricular::firstWhere('slug', 'robotik-club')->image;
        $this->assertStringEndsWith('.webp', $path);
        [$width, $height] = getimagesizefromstring(Storage::disk('public')->get($path));
        $this->assertSame([1600, 1200], [$width, $height]);
        [$cardWidth] = getimagesizefromstring(Storage::disk('public')->get(Media::cardPath($path)));
        $this->assertSame(640, $cardWidth);
    }

    public function test_card_style_must_be_valid(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.extracurriculars.store'), $this->validData(['card_style' => 'raksasa']))
            ->assertSessionHasErrors('card_style');
    }

    public function test_admin_can_update_and_delete_extracurricular(): void
    {
        $ekskul = Extracurricular::create(['name' => 'Lama', 'slug' => 'lama']);

        $this->actingAs($this->admin)
            ->put(route('admin.extracurriculars.update', $ekskul), $this->validData(['name' => 'Baru', 'slug' => 'lama']))
            ->assertRedirect(route('admin.extracurriculars.index'));
        $this->assertSame('Baru', $ekskul->fresh()->name);

        $this->actingAs($this->admin)->delete(route('admin.extracurriculars.destroy', $ekskul->fresh()));
        $this->assertModelMissing($ekskul);
    }

    public function test_detail_page_uses_card_image(): void
    {
        $ekskul = Extracurricular::create(['name' => 'Silat', 'slug' => 'silat', 'image' => 'assets/ekskul/silat.webp', 'is_active' => true]);

        $this->get(route('ekstrakurikuler.show', $ekskul))->assertOk()->assertSee($ekskul->image_url, false);
    }

    public function test_public_page_shows_active_extracurriculars(): void
    {
        $this->seed(ExtracurricularSeeder::class);
        Extracurricular::firstWhere('slug', 'pmr')->update(['is_active' => false]);

        $this->get(route('ekstrakurikuler'))
            ->assertOk()
            ->assertSee('ekskul-card featured" data-reveal', false)
            ->assertSee('ekskul-card tall" data-reveal', false)
            ->assertSee('Hizbul Wathan (HW)')
            ->assertDontSee('PMR Wira Unit SMEMSA');
    }

    public function test_cards_link_to_detail_page_instead_of_modal(): void
    {
        $this->seed(ExtracurricularSeeder::class);

        $this->get(route('ekstrakurikuler'))
            ->assertOk()
            ->assertSee('href="'.route('ekstrakurikuler.show', 'hw').'"', false)
            ->assertDontSee('openEkskulModal')
            ->assertDontSee('ekskul-modal');
    }

    public function test_detail_page_shows_program_information(): void
    {
        $ekskul = Extracurricular::create([
            'name' => 'Robotik Club', 'slug' => 'robotik', 'tag' => 'Sains & Teknologi',
            'short_description' => 'Ringkasan robotik.', 'description' => "Paragraf satu.\n\nParagraf dua.",
            'schedule' => 'Sabtu, 08:00', 'coach_name' => 'Pak Budi', 'location' => 'Lab RPL', 'audience' => 'Kelas X',
            'achievements' => ['Juara 1 Robotik Nasional'],
        ]);
        Extracurricular::create(['name' => 'Futsal', 'slug' => 'futsal']);

        $this->get(route('ekstrakurikuler.show', $ekskul))
            ->assertOk()
            ->assertSee('Robotik Club')
            ->assertSee('Sains &amp; Teknologi', false)
            ->assertSee('<p>Paragraf dua.</p>', false)
            ->assertSee('Sabtu, 08:00')
            ->assertSee('Pak Budi')
            ->assertSee('Lab RPL')
            ->assertSee('Kelas X')
            ->assertSee('Juara 1 Robotik Nasional')
            ->assertSee('Ekstrakurikuler Lainnya')
            ->assertSee('Futsal');
    }

    public function test_inactive_extracurricular_detail_returns_404(): void
    {
        $ekskul = Extracurricular::create(['name' => 'Arsip', 'slug' => 'arsip', 'is_active' => false]);

        $this->get(route('ekstrakurikuler.show', $ekskul))->assertNotFound();
    }

    public function test_public_page_shows_empty_state(): void
    {
        $this->get(route('ekstrakurikuler'))
            ->assertOk()
            ->assertSee('Data ekstrakurikuler belum tersedia');
    }
}
