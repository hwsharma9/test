<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

    	$users = [
    		[
                'name' => 'Super Admin',
	            'email' => 'superadmin@gmail.com',
	            'email_verified_at' => now(),
	            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    		],
    		[
                'name' => 'Editor',
	            'email' => 'editor@gmail.com',
	            'email_verified_at' => now(),
	            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    		],
    		[
                'name' => 'Reader',
	            'email' => 'reader@gmail.com',
	            'email_verified_at' => now(),
	            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    		],
    	];

        if ($users) {
        	foreach ($users as $key => $value) {
        		$user = User::create($value);
        		if ($value['name'] == 'Super Admin') {
        			$roles = Role::where('slug', 'super-admin')->first();
        			$user->roles()->attach($roles);
        			$permissions = Permission::all();
        			$user->permissions()->attach($permissions);
        		} elseif ($value['name'] == 'Editor') {
        			$roles = Role::where('slug', 'editor')->first();
        			$user->roles()->attach($roles);
        			$permissions = Permission::whereIn('slug', ['list-post', 'update-post'])->get();
        			$user->permissions()->attach($permissions);
        		} elseif ($value['name'] == 'Reader') {
        			$roles = Role::where('slug', 'reader')->first();
        			$user->roles()->attach($roles);
        			$permissions = Permission::where('slug', 'read-post')->first();
        			$user->permissions()->attach($permissions);
        		}
        	}
        }
    }
}
