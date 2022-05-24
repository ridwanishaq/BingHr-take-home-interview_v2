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
        // $users = [
        //     [
        //         'employeeID'     => Str::random(11),
        //         'name'           => 'Ridwan Ishaq',
        //         'email'          => 'superadmin@binghr.com',
        //         'mobile_no'      => '09088776655',
        //         'username'       => 'ridwan',
        //         'password'       => bcrypt(12345678),
        //     ],
        //     [
        //         'employeeID'     => Str::random(11),
        //         'name'           => 'John Samuel',
        //         'email'          => 'admin@binghr.com',
        //         'mobile_no'      => '09088776656',
        //         'username'       => 'john',
        //         'password'       => bcrypt(12345678),
        //     ],
        //     [
        //         'employeeID'     => Str::random(11),
        //         'name'           => 'Usman Abubakar',
        //         'email'          => 'employee@binghr.com',
        //         'mobile_no'      => '09088776657',
        //         'username'       => 'usman',
        //         'password'       => bcrypt(12345678),
        //     ],
        //     [
        //         'employeeID'     => Str::random(11),
        //         'name'           => 'Aliu Abdul',
        //         'email'          => 'ali@binghr.com',
        //         'mobile_no'      => '09088776658',
        //         'username'       => 'aliyu',
        //         'password'       => bcrypt(12345678),
        //     ]
        // ];


        // foreach($users as $key => $user){
        //     User::create($user);
        // }

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
