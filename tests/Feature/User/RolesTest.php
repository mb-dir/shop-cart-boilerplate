<?php

namespace Tests\Feature\User;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RolesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_cannot_edit_product(): void
    {
        // By default user is not an admin
        $user = User::factory()->create();
        $product = Product::create(['name' => 'test', 'price' => 1, 'photo' => null]);

        $response = $this->actingAs($user)->post(route('product.update', $product), ['name' => 'editName']);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'You are not an admin!');
        $this->assertEquals('test', $product->fresh()->name);
    }

    public function test_admin_can_edit_product(): void
    {
        // By default user is not an admin
        $user = User::create(
            [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'is_admin' => 1,
            ]
        );
        $product = Product::create(['name' => 'test', 'price' => 1, 'photo' => null]);

        $response = $this->actingAs($user)->post(route('product.update', $product), ['name' => 'editName', 'price' => 1, 'photo' => null]);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Product updated successfully.');
        $this->assertEquals('editName', $product->fresh()->name);
    }
}
