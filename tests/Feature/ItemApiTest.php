<?php

namespace Tests\Feature;

use Tests\TestCase;

class ItemApiTest extends TestCase 
{
    /** @test */
    public function test_guest_cannot_access_items()
    {
        $response = $this->getJson('/api/v1/items', ['Authorization' => 'Bearer salah_token']);
        $response->assertStatus(401);
    }

    /** @test */
    public function test_user_can_list_items()
    {
        $response = $this->getJson('/api/v1/items', ['Authorization' => 'Bearer token_user_simulated']);
        $response->assertStatus(200);
    }

    /** @test */
    public function test_user_cannot_delete_item()
    {
        $response = $this->deleteJson('/api/v1/items/1', [], ['Authorization' => 'Bearer token_user_simulated']);
        $response->assertStatus(403);
    }

    /** @test */
    public function test_admin_can_delete_item()
    {
        $response = $this->deleteJson('/api/v1/items/1', [], ['Authorization' => 'Bearer token_admin_simulated']);
        $response->assertStatus(204);
    }
}