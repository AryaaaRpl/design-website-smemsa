<?php

namespace Tests\Feature\Admin;

use App\Enums\TeacherCategory;
use App\Models\Major;
use App\Models\Teacher;
use App\Models\User;
use Database\Seeders\MajorSeeder;
use Database\Seeders\TeacherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherTest extends TestCase
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
            'name' => 'Budi Santoso, S.Pd',
            'position' => 'Mata Pelajaran Umum',
            'category' => 'guru',
            'sort_order' => 1,
            'is_active' => '1',
        ], $overrides);
    }

    public function test_guest_cannot_access_teachers(): void
    {
        $this->get(route('admin.teachers.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_teacher(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.teachers.store'), $this->validData())
            ->assertRedirect(route('admin.teachers.index'));

        $this->assertDatabaseHas('teachers', ['slug' => 'budi-santoso-spd', 'category' => 'guru']);
    }

    public function test_principal_can_only_be_one_person(): void
    {
        Teacher::create(['name' => 'Kepsek Lama', 'slug' => 'kepsek-lama', 'position' => 'Kepala', 'category' => TeacherCategory::Principal]);

        $this->actingAs($this->admin)
            ->post(route('admin.teachers.store'), $this->validData(['category' => 'kepsek']))
            ->assertSessionHasErrors(['category' => 'Kepala Sekolah sudah diisi oleh Kepsek Lama. Ubah dulu kategori data tersebut.']);
    }

    public function test_updating_current_principal_is_allowed(): void
    {
        $principal = Teacher::create(['name' => 'Kepsek', 'slug' => 'kepsek', 'position' => 'Kepala', 'category' => TeacherCategory::Principal]);

        $this->actingAs($this->admin)
            ->put(route('admin.teachers.update', $principal), $this->validData(['category' => 'kepsek', 'slug' => 'kepsek', 'name' => 'Kepsek Baru']))
            ->assertSessionHasNoErrors();

        $this->assertSame('Kepsek Baru', $principal->fresh()->name);
    }

    public function test_head_of_major_requires_major(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.teachers.store'), $this->validData(['category' => 'k3']))
            ->assertSessionHasErrors('major_id');
    }

    public function test_page_array_uses_major_label_and_page_group(): void
    {
        $major = Major::create(['code' => 'PPLG', 'name' => 'PPLG', 'short_name' => 'PPLG', 'slug' => 'rpl']);
        $teacher = Teacher::create([
            'name' => 'Dinda', 'slug' => 'dinda', 'position' => 'Ketua Program',
            'category' => TeacherCategory::HeadOfMajor, 'major_id' => $major->id,
        ]);
        $staff = new Teacher(['name' => 'Staf', 'position' => 'Staff Karyawan', 'category' => TeacherCategory::Staff]);

        $this->assertSame('PPLG', $teacher->toPageArray()['jurusan']);
        $this->assertSame('k3', $teacher->toPageArray()['kategori']);
        $this->assertSame('tendik', $staff->toPageArray()['kategori']);
        $this->assertNull($staff->toPageArray()['foto']);
    }

    public function test_public_page_shows_seeded_teachers(): void
    {
        $this->seed([MajorSeeder::class, TeacherSeeder::class]);
        Teacher::where('name', 'like', 'Rudi Hariyanto%')->update(['is_active' => false]);

        $this->get(route('guru'))
            ->assertOk()
            ->assertSee('Wahid Wahyudi, S.Ag., M.Pd')
            ->assertSee('Kepala SMKS Muhammadiyah 1 Genteng')
            ->assertSee('<span id="stat-tendik">15</span>', false)
            ->assertDontSee('Rudi Hariyanto');
    }

    public function test_seeded_photos_prefer_webp(): void
    {
        $this->seed([MajorSeeder::class, TeacherSeeder::class]);

        $nonWebp = Teacher::where('photo', 'not like', '%.webp')->pluck('photo');

        // Hanya foto yang memang tidak punya versi webp.
        $this->assertSame(['assets/PAK-WAHID-AI-e1781064934191.png'], $nonWebp->all());
        $this->assertSame(62, Teacher::count());
    }

    public function test_public_page_without_teachers_shows_empty_messages(): void
    {
        $this->get(route('guru'))
            ->assertOk()
            ->assertSee('Data belum tersedia')
            ->assertSee('<span id="stat-tendik">0</span>', false);
    }
}
