<?php

namespace Tests\Feature\Employee;

use Tests\TestCase;

class DeleteTest extends TestCase
{
    public function testDeleteRequest()
    {
        $response = $this->deleteJson('/api/employees/50');
        $response
            ->assertStatus(204);
    }

}
