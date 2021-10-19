<?php

namespace Tests\Feature\Employee;

use Tests\TestCase;

class IndexTest extends TestCase
{
    public function testIndexRequest()
    {
        $response = $this->getJson('/api/employees');
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'OK'
            ]);
    }

    public function testMethodNotAllowed()
    {
        $response = $this->postJson('/api/employees');
        $response->assertStatus(405);
    }

}
