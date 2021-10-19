<?php

namespace Tests\Feature\Employee;

use Tests\TestCase;

class ShowTest extends TestCase
{
    public function testValidId()
    {
        $response = $this->getJson('/api/employees/1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'OK'
            ]);
    }

    public function testInvalidId(){
        $response = $this->getJson('/api/employees/aaa');
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Employee not found'
            ]);

    }
}
