<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Contracts\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'show ticket']);
        Permission::create(['name'=>'update ticket']);
        Permission::create(['name'=>'create ticket']);
        Permission::create(['name'=>'destroy ticket']);
    }
}
