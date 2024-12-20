<?php

use App\Models\User;

it('auth user can see create contact page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('contacts.create'));

    $response->assertStatus(200);

    $response->assertViewIs('contacts.create');

    $response->assertSee('Create Contact');

});

it('guest cannot see create contact page', function () {
    $response = $this->get(route('contacts.create'));

    $response->assertStatus(302);

    $response->assertRedirect(route('login'));
});
