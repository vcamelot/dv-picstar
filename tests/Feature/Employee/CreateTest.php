<?php

namespace Tests\Feature\Employee;

use Tests\TestCase;
use Carbon\Carbon;

class CreateTest extends TestCase
{

    public function testValidEmployee()
    {
        $response = $this->json('POST', '/api/employees/create', [
            'name' => 'John Doe',
            'position' => 'manager',
            'start_date' => '2020-01-01'
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Employee created',
            ])->assertJsonPath('data.name', 'John Doe');
    }

    public function testMissingSuperiorId()
    {
        $response = $this->json('POST', '/api/employees/create', [
            'name' => 'John Doe',
            'position' => 'associate',
            'start_date' => '2020-01-01'
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonPath(
                'errors.superior_id.0',
                'The superior id field is required when position is associate.');
    }

    public function testInvalidStartDate()
    {
        $response = $this->json('POST', '/api/employees/create', [
            'name' => 'John Doe',
            'position' => 'associate',
            'start_date' => Carbon::now()->addDays(5)->format('Y-m-d')
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonPath(
                'errors.start_date.0',
                'The start date must be a date before now.');

    }
}
