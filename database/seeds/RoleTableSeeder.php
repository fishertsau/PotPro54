<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    protected $roleList;

    public function __construct()
    {
        $this->roleList = json_decode(Storage::get('role.json'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roleList as $role) {
            \App\Models\Authorization\Role::create([
                'name' => $role->name,
                'description' => $role->description,
                'category' => $role->category]);
        }
    }
}
