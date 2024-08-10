<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    // Update the role associated with a user
    public function update_user_role(Request $request, string $id)
    {
        if (Auth::user()->can('update.role')) {
            $user = User::find($id);
            if ($user) {
                $user->roles()->sync($request->role_id);
                $role = $user->getRoleNames();
                return $this->responseService->success_response($role);
            } else {
                return $this->responseService->notFound_response('کاربر');
            }
        } else {
            return $this->responseService->unauthorized_response();
        }
    }

}
