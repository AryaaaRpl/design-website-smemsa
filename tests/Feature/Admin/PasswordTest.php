<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['password' => 'lama12345']);
    }

    public function test_guest_cannot_access_password_page(): void
    {
        $this->get(route('admin.password.edit'))->assertRedirect(route('admin.login'));
        $this->put(route('admin.password.update'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_change_password(): void
    {
        $this->actingAs($this->admin)->get(route('admin.password.edit'))->assertOk();

        $this->actingAs($this->admin)
            ->put(route('admin.password.update'), [
                'current_password' => 'lama12345',
                'password' => 'baru67890',
                'password_confirmation' => 'baru67890',
            ])
            ->assertRedirect(route('admin.password.edit'))
            ->assertSessionHas('success');

        $this->assertTrue(Hash::check('baru67890', $this->admin->fresh()->password));
    }

    public function test_password_is_not_changed_when_input_is_invalid(): void
    {
        $cases = [
            'current_password' => ['current_password' => 'salah', 'password' => 'baru67890', 'password_confirmation' => 'baru67890'],
            'password' => ['current_password' => 'lama12345', 'password' => 'baru67890', 'password_confirmation' => 'beda67890'],
        ];

        foreach ($cases as $field => $data) {
            $this->actingAs($this->admin)
                ->put(route('admin.password.update'), $data)
                ->assertSessionHasErrors($field);
        }

        foreach (['pendek1', 'tanpaangka', 'lama12345'] as $weak) {
            $this->actingAs($this->admin)
                ->put(route('admin.password.update'), [
                    'current_password' => 'lama12345',
                    'password' => $weak,
                    'password_confirmation' => $weak,
                ])
                ->assertSessionHasErrors('password');
        }

        $this->assertTrue(Hash::check('lama12345', $this->admin->fresh()->password));
    }
}
