<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'employeeID'     => Str::random(11),
            'name'           => 'Ridwan Ishaq',
            'email'          => 'superadmin@binghr.com',
            'mobile_no'      => '09088776655',
            'username'       => 'ridwan',
            'password'       => bcrypt('12345678')
        ]);


        $role = Role::create(['name' => 'Super Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
