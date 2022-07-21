<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();

        $roles = [
            ["name" => "admin", "created_at" => Carbon::now(), 'updated_at' => Carbon::now()],
            ["name" => "applicant", "created_at" => Carbon::now(), 'updated_at' => Carbon::now()]
        ];

        Role::updateOrCreate($roles);
        Schema::enableForeignKeyConstraints();
    }
}
