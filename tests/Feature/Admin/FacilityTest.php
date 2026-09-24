<?php

namespace Tests\Feature\Admin;

use App\Enums\FacilityType;
use App\Models\Facility;
use App\Models\User;
use Database\Seeders\FacilitySeeder;
use Database\Seeders\MajorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FacilityTest extends TestCase
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
            'name' => 'Lab Robotika',
            'type' => 'lab',
            'icon' => 'computer',
            'sort_order' => 1,
            'features' => "Arduino\n\nSensor Kit\n",
            'map_x' => 500,
            'map_y' => 400,
        ], $overrides);
    }

    public function test_guest_cannot_access_facilities(): void
    {
        $this->get(route('admin.facilities.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_facility_with_gallery(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin)
            ->post(route('admin.facilities.store'), $this->validData([
                'new_images' => [
                    UploadedFile::fake()->create('a.webp', 100, 'image/webp'),
                    UploadedFile::fake()->create('b.webp', 100, 'image/webp'),
                ],
            ]))
            ->assertRedirect(route('admin.facilities.index'));

        $facility = Facility::firstWhere('slug', 'lab-robotika');

        $this->assertSame(['Arduino', 'Sensor Kit'], $facility->features);
        $this->assertSame([1, 2], $facility->images->pluck('sort_order')->all());
        Storage::disk('public')->assertExists($facility->images->first()->path);
    }

    public function test_map_point_needs_both_coordinates(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.facilities.store'), $this->validData(['map_y' => null]))
            ->assertSessionHasErrors('map_y');

        $this->actingAs($this->admin)
            ->post(route('admin.facilities.store'), $this->validData(['map_x' => 1200]))
            ->assertSessionHasErrors('map_x');
    }

    public function test_facility_without_map_point_is_allowed(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.facilities.store'), $this->validData(['map_x' => null, 'map_y' => null]))
            ->assertSessionHasNoErrors();

        $this->assertNull(Facility::first()->map_x);
    }

    public function test_admin_can_update_caption_and_delete_image(): void
    {
        Storage::fake('public');
        $facility = Facility::create(['name' => 'Lab', 'slug' => 'lab', 'type' => FacilityType::Laboratory]);
        $keep = $facility->images()->create(['path' => 'facilities/keep.webp', 'sort_order' => 1]);
        $remove = $facility->images()->create(['path' => 'facilities/remove.webp', 'sort_order' => 2]);
        Storage::disk('public')->put('facilities/remove.webp', 'x');

        $this->actingAs($this->admin)
            ->put(route('admin.facilities.update', $facility), $this->validData([
                'slug' => 'lab',
                'images' => [
                    $keep->id => ['caption' => 'Tampak depan', 'sort_order' => 1],
                    $remove->id => ['caption' => '', 'sort_order' => 2, 'delete' => '1'],
                ],
            ]))
            ->assertRedirect(route('admin.facilities.index'));

        $this->assertSame('Tampak depan', $keep->fresh()->caption);
        $this->assertModelMissing($remove);
        Storage::disk('public')->assertMissing('facilities/remove.webp');
    }

    public function test_public_page_shows_seeded_facilities(): void
    {
        $this->seed([MajorSeeder::class, FacilitySeeder::class]);

        $response = $this->get(route('fasilitas'))->assertOk();

        $response->assertSee('Semua Lokasi <span class="count">14</span>', false)
            ->assertSee('Teaching Factory <span class="count">6</span>', false)
            ->assertSee('Fasilitas Umum <span class="count">8</span>', false)
            ->assertSee('Tefa Tekaje Solution')
            ->assertSee('fac-card wide', false)
            ->assertSee('view-1.webp');

        // Semua foto seeder memakai webp & file-nya ada.
        foreach (\App\Models\FacilityImage::pluck('path') as $path) {
            $this->assertStringEndsWith('.webp', $path);
            $this->assertFileExists(public_path($path));
        }
    }

    public function test_public_page_without_facilities_shows_empty_states(): void
    {
        $this->get(route('fasilitas'))
            ->assertOk()
            ->assertSee('Data lokasi fasilitas belum tersedia')
            ->assertSee('Data fasilitas belum tersedia')
            ->assertDontSee('class="tefa-section"', false)
            ->assertDontSee('id="indexGrid"', false);
    }
}
