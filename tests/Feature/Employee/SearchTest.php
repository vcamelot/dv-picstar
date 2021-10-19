<?php

namespace Tests\Feature\Employee;

use Tests\TestCase;

class SearchTest extends TestCase
{
    public function testValidPosition()
    {
        $response = $this->getJson('/api/employees/search?position=associate');
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'OK'
            ]);
    }

    public function testInvalidPosition()
    {
        $response = $this->getJson('/api/employees/search?position=abcabc');
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'No matching employees found'
            ]);
    }

}

