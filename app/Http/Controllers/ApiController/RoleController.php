<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Retrieve a list of all roles
    public function role_index(Request $request)
    {
        $roles = Role::all();
        return $this->success_response($roles);
    }

    // Retrieve a list of all permissions
    public function permission_index(Request $request)
    {
        $roles = Permission::all();
        return $this->success_response($roles);
    }

    // Create a new role
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        return $this->success_response($role);
    }

    // Update an existing role
    public function update(Request $request, string $id)
    {
        $role = Role::find($id)->update(['name' => $request->name]);
        return $this->success_response($role);
    }

    // Delete a role
    public function destroy(string $id)
    {
        Role::destroy($id);
        return $this->delete_response();
    }

    // Update the permissions associated with a role
    public function update_role_permissions(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->permissions()->sync($request->permissions);
        return $this->success_response($role);
    }

    // Retrieve a list of a user permissions
    public function show_user_roles(Request $request, string $id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();
        return $this->success_response($roles);
    }

    // Update the roles associated with a user
    public function update_user_roles(Request $request, string $id)
    {
        $user = User::find($id);
        $user->roles()->sync($request->roles);
        $roles = $user->getRoleNames();
        return $this->success_response($roles);
    }

    // Retrieve a list of a user permissions
    public function show_user_permissions(Request $request, string $id)
    {
        $user = User::find($id);
        $permissions = $user->getPermissionNames();
        return $this->success_response($permissions);
    }

    // Update the permissions directly associated with a user
    public function update_user_permissions(Request $request, string $id)
    {
        $user = User::find($id);
        $user->permissions()->sync($request->permissions);
        $permissions = $user->getPermissionNames();
        return $this->success_response($permissions);
    }

}
