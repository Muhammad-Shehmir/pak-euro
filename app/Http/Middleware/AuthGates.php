<?php

namespace App\Http\Middleware;

use App\Models\Role as ModelsRole;
use App\Models\User;
use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        // dd($user);
        if (!app()->runningInConsole() && $user) {
            $roles = ModelsRole::with('permissions')->get();

            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    // $permissionsArray[$permissions->title][] = $role->id;
                    $permissionsArray[$permissions->permission_master->title][] = $role->id;
                    // dd($permissions->permission_master);
                }
            }
            if (isset($permissionsArray)) {
                foreach ($permissionsArray as $title => $roles) {
                    // dd($title);
                    // Gate::define($title, function ($user) use ($roles) {
                    //     // return $user->role_id == $role_id;
                    //     return in_array($user->role_id, $roles);
                    // });
                    // dd('test');
                    // dd($user->role_users);
                    // dd(count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0);
                    Gate::define($title, function (User $user) use ($roles) {
                        // dd($roles);
                        // dd($user->role_users->pluck('role_id')->toArray());
                        return count(array_intersect($user->role_users->pluck('role_id')->toArray(), $roles)) > 0;
                    });
                }
            }
        }
        // dd(Gate::abilities());

        return $next($request);
    }
}
