<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

    	$permissions = [
    		[
                'name'  => 'List Post',
                'slug'  => 'list-post',
    		],
    		[
                'name'  => 'Create Post',
                'slug'  => 'create-post',
    		],
    		[
                'name'  => 'Read Post',
                'slug'  => 'read-post',
    		],
    		[
                'name'  => 'Update Post',
                'slug'  => 'update-post',
    		],
    		[
                'name'  => 'Delete Post',
                'slug'  => 'delete-post',
    		]
    	];

        if ($permissions) {
        	foreach ($permissions as $key => $value) {
        		Permission::create($value);
        	}
        }
    }
}
