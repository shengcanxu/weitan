<?php

namespace App\Models;


use Zizaco\Entrust\EntrustPermission;

/**
 * App\Models\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @mixin \Eloquent
 */
class Permission extends EntrustPermission
{
}