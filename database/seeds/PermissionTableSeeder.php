<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{

    protected $permissionList;

    public function __construct()
    {
        $this->permissionList = json_decode(Storage::get('permission.json'));
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissionList as $permission) {
            \App\Models\Authorization\Permission::create([
                'name' => $permission->name,
                'description' => $permission->description,
                'category'=>$permission->category]);
        }
    }
}
