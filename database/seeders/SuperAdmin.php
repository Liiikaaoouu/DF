<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::all();
        if (!Role::where('name', 'super-admin')->exists()) {
            $superad = Role::create(['name' => 'super-admin']);
            $superad->givePermissionTo($permission);
        }

        $superUser = User::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'password' => bcrypt('x5410041'),
        ]);

        $superId = $superUser->id;

        $superad->update([
            'team_id' => $superId
        ]);

        $superad->save();

        $superUser->assignRole('super-admin');

    }
}
