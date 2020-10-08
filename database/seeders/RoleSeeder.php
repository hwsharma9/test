<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            [
                'name'  => 'Super Admin',
                'slug'  => 'super-admin',
            ],
            [
                'name'  => 'Editor',
                'slug'  => 'editor',
            ],
            [
                'name'  => 'Reader',
                'slug'  => 'reader',
            ],
        ];

        if ($roles) {
        	foreach ($roles as $key => $value) {
        		$role = Role::create($value);
        		if ($value['slug'] == 'super-admin') {
        			$permissions = Permission::all();
        		} elseif ($value['slug'] == 'editor') {
        			$permissions = Permission::where('slug', 'update-post')->get();
        		} elseif ($value['slug'] == 'reader') {
        			$permissions = Permission::where('slug', 'read-post')->get();
        		}
        		$role->permissions()->attach($permissions);
        	}
        }
    }
}
