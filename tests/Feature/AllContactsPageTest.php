<?php

use App\Models\User;

it('auth user can see contacts page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('contacts.index'));

    $response->assertStatus(200);

    $response->assertViewIs('contacts.index');

    $response->assertSee('Contacts');

});

it('guest cannot see contacts page', function () {
    $response = $this->get(route('contacts.index'));

    $response->assertStatus(302);

    $response->assertRedirect(route('login'));
});
