<?php

namespace App\Traits;

use App\Models\Authorization\Role;

trait SiteRoles
{
    public function roles()
    {
        return $this->belongsToMany('App\Models\Authorization\Role');
    }

    public function assignRole($role)
    {
        $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }


    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        //when $role is collection of model Role
        return !!$role->intersect($this->roles)->count();

//        foreach ($role as $r) {
//            if ($this->hasRole($r->name)) {
//                return true;
//            }
//        }

    }




}