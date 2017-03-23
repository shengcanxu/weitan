<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\User;

class TestController extends Controller
{
    public function  index2(){
        return view('test');
    }

    public function  index(){
//        $owner = new Role();
//        $owner->name         = 'owner';
//        $owner->display_name = 'Project Owner'; // optional
//        $owner->description  = 'User is the owner of a given project'; // optional
//        $owner->save();
//
//        $admin = new Role();
//        $admin->name         = 'admin';
//        $admin->display_name = 'User Administrator'; // optional
//        $admin->description  = 'User is allowed to manage and edit other users'; // optional
//        $admin->save();
//
//        $user = User::where('name', '=', 'cano')->first();
//
//
//        $user->attachRole($admin); // parameter can be an Role object, array, or id
//
//
//
//        $createPost = new Permission();
//        $createPost->name         = 'create-post';
//        $createPost->display_name = 'Create Posts'; // optional
//
//        $createPost->description  = 'create new blog posts'; // optional
//        $createPost->save();
//
//        $editUser = new Permission();
//        $editUser->name         = 'edit-user';
//        $editUser->display_name = 'Edit Users'; // optional
//
//        $editUser->description  = 'edit existing users'; // optional
//        $editUser->save();
//
//        $admin->attachPermission($createPost);
//
//
//        $owner->attachPermissions(array($createPost, $editUser));


        $user = User::where('name', '=', 'cano')->first();
        var_dump($user->hasRole('owner'));   // false
        var_dump($user->hasRole('admin'));   // true
        var_dump($user->can('edit-user'));   // false
        var_dump($user->can('create-post')); // true

        return view("test");
    }
}
