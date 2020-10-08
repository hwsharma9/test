<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class PermissionController extends Controller
{
    public function Permission()
    {
    	$create_post = Permission::where('slug','create-post')->first();
    	$update_post = Permission::where('slug','update-post')->first();
    	$delete_post = Permission::where('slug','delete-post')->first();
    	$read_post = Permission::where('slug','read-post')->first();

		//RoleTableSeeder.php
		$dev_role = new Role();
		$dev_role->slug = 'super-admin';
		$dev_role->name = 'Super Admin';
		$dev_role->save();
		$dev_role->permissions()->attach($create_post);
		$dev_role->permissions()->attach($update_post);
		$dev_role->permissions()->attach($delete_post);

		$manager_role = new Role();
		$manager_role->slug = 'editor';
		$manager_role->name = 'Editor';
		$manager_role->save();
		$manager_role->permissions()->attach($edit_post);

		$manager_role = new Role();
		$manager_role->slug = 'reader';
		$manager_role->name = 'Reader';
		$manager_role->save();
		$manager_role->permissions()->attach($read_post);

		$sa_role = Role::where('slug','super-admin')->first();
		$editor_role = Role::where('slug', 'editor')->first();
		$reader_role = Role::where('slug', 'reader')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-post';
		$createTasks->name = 'Create Post';
		$createTasks->save();
		$createTasks->roles()->attach($sa_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);

		$dev_role = Role::where('slug','developer')->first();
		$manager_role = Role::where('slug', 'manager')->first();
		$dev_perm = Permission::where('slug','create-tasks')->first();
		$manager_perm = Permission::where('slug','edit-users')->first();

		$developer = new User();
		$developer->name = 'Harsukh Makwana';
		$developer->email = 'harsukh21@gmail.com';
		$developer->password = bcrypt('harsukh21');
		$developer->save();
		$developer->roles()->attach($dev_role);
		$developer->permissions()->attach($dev_perm);

		$manager = new User();
		$manager->name = 'Jitesh Meniya';
		$manager->email = 'jitesh21@gmail.com';
		$manager->password = bcrypt('jitesh21');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);

		
		// return redirect()->back();
    }
}
