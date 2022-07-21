<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            ["name" => "admin", "created_at" => Carbon::now(), 'updated_at' => Carbon::now()],
            ["name" => "applicant", "created_at" => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        Role::insert($roles);
    }
}
