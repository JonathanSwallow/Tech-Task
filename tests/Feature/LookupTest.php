<?php

namespace Tests\Feature;

use Tests\TestCase;

class LookupTest extends TestCase
{
    public function test_lookup_fails_with_unsupported_types()
    {
        $response = $this->getJson('/lookup?type=invalid');
        $response->assertStatus(422)
            ->assertSee('invalid is not valid');
    }

    public function test_lookup_fails_with_no_type_passed()
    {
        $response = $this->getJson('/lookup');
        $response->assertStatus(422)
            ->assertSee('A type must be specified');
    }

    public function test_lookup_fails_when_no_id_or_username_provided()
    {
        $response = $this->getJson('/lookup?type=minecraft');
        $response->assertStatus(422)
            ->assertSee('Either an ID or a username must be provided.');
    }

    public function test_lookup_fails_when_both_id_and_username_provided()
    {
        $response = $this->getJson('/lookup?type=minecraft&id=12345&username=player');
        $response->assertStatus(422)
            ->assertSee('You cannot provide both an ID and a username.');
    }
}
