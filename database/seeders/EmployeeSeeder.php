<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            DB::table('employees')->insert([
                'name' => $faker->name,
                'position' => 'manager',
                'superior_id' => null,
                'start_date' => $faker->dateTimeBetween('-10 years', '-5 year'),
                'end_date' => random_int(0, 1) == 1 ?
                    $faker->dateTimeBetween('-2 years', '-1 month') : null,
                'created_at' => Carbon::now()
            ]);
        }

        $managerIds = Employee::latest()->take(5)->get()->pluck('id')->toArray();

        foreach (range(1, 50) as $index) {
            DB::table('employees')->insert([
                'name' => $faker->name,
                'position' => 'associate',
                'superior_id' => $managerIds[array_rand($managerIds)],
                'start_date' => $faker->dateTimeBetween('-10 years', '-5 year'),
                'end_date' => random_int(0, 1) == 1 ?
                    $faker->dateTimeBetween('-2 years', '-1 month') : null,
                'created_at' => Carbon::now()
            ]);
        }

    }
}
