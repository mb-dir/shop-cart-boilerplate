<?php

namespace Tests\Feature\Cart;


use App\Models\User;
use App\Services\CartManager;
use Tests\TestCase;


class CartTest extends TestCase
{
    public function test_cannot_create_new_cart_as_guest()
    {
        $cartManager = new CartManager();

        $cart = $cartManager->create();

        $this->assertNull($cart);
    }


    public function test_create_new_cart_and_attach_it_to_user(): void
    {
        $cartManager = new CartManager();
        $user = User::factory()->create();

        $this->actingAs($user);

        $cart = $cartManager->create();

        $this->assertNotNull($cart);
        $this->assertEquals($user->id, $cart->user->id);
    }


    public function test_delete_cart()
    {
        $cartManager = new CartManager();
        $user = User::factory()->create();

        $this->actingAs($user);

        $cartManager->create();
        $this->assertNotNull($cartManager->cart());

        $cartManager->destroy();
        $this->assertNull($cartManager->cart());
    }


    public function test_id_method_returns_cart_id()
    {
        $cartManager = new CartManager();
        $user = User::factory()->create();

        $this->actingAs($user);

        $cart = $cartManager->create();

        $this->assertEquals($cart->id, $cartManager->id());
    }


    public function test_shared_method_returns_cart_with_loaded_items()
    {
        $cartManager = new CartManager();
        $user = User::factory()->create();

        $this->actingAs($user);

        $cart = $cartManager->create();
        $this->assertFalse($cart->relationLoaded('items'));

        $cartManager->shared();
        $this->assertTrue($cart->relationLoaded('items'));
    }
}
