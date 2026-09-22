<?php

namespace Tests\Feature\Admin;

use App\Models\Major;
use App\Models\User;
use Database\Seeders\MajorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MajorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'code' => 'TKR',
            'name' => 'Teknik Kendaraan Ringan',
            'description' => 'Deskripsi jurusan.',
            'competencies' => "Mesin\nKelistrikan\n\n",
            'sort_order' => 8,
            'is_active' => '1',
        ], $overrides);
    }

    public function test_guest_cannot_access_majors(): void
    {
        auth()->logout();

        $this->get(route('admin.majors.index'))->assertRedirect(route('admin.login'));
    }

    public function test_index_lists_majors(): void
    {
        $this->seed(MajorSeeder::class);

        $this->get(route('admin.majors.index'))
            ->assertOk()
            ->assertSee('PPLG')
            ->assertSee('Perhotelan');
    }

    public function test_admin_can_create_major_with_logo(): void
    {
        Storage::fake('public');

        $this->post(route('admin.majors.store'), $this->validData([
            'logo' => UploadedFile::fake()->create('logo.png', 100, 'image/png'),
        ]))->assertRedirect(route('admin.majors.index'));

        $major = Major::firstWhere('code', 'TKR');

        $this->assertSame('teknik-kendaraan-ringan', $major->slug);
        $this->assertSame(['Mesin', 'Kelistrikan'], $major->competencies);
        Storage::disk('public')->assertExists($major->logo);
    }

    public function test_code_must_be_unique(): void
    {
        Major::create(['code' => 'TKR', 'name' => 'Lama', 'slug' => 'lama']);

        $this->post(route('admin.majors.store'), $this->validData())
            ->assertSessionHasErrors('code');
    }

    public function test_admin_can_update_major(): void
    {
        $major = Major::create(['code' => 'TKR', 'name' => 'Lama', 'slug' => 'tkr']);

        $this->put(route('admin.majors.update', $major), $this->validData(['slug' => 'tkr', 'name' => 'Baru']))
            ->assertRedirect(route('admin.majors.index'));

        $this->assertSame('Baru', $major->fresh()->name);
    }

    public function test_admin_can_delete_major(): void
    {
        $major = Major::create(['code' => 'TKR', 'name' => 'Lama', 'slug' => 'tkr']);

        $this->delete(route('admin.majors.destroy', $major))->assertRedirect(route('admin.majors.index'));

        $this->assertModelMissing($major);
    }

    public function test_home_page_shows_empty_state_when_no_majors(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Data jurusan belum tersedia');
    }

    public function test_home_page_shows_active_majors_from_database(): void
    {
        $this->seed(MajorSeeder::class);
        Major::firstWhere('code', 'PH')->update(['is_active' => false]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Pengembang Perangkat Lunak')
            ->assertDontSee('Edutel Hotel SMEMSA');
    }
}
