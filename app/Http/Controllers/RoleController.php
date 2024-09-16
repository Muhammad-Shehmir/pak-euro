<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LogsController;
use App\Models\Permission;
use App\Models\PermissionRoles;
use App\Models\Role;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class RoleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, LogsController $logController)
    {
        try {

            $title = $request->title;
            $perPage = $request->input('perPage', session('perPage', 10));
            session(['perPage' => $perPage]);

            $roles = Role::when($title, function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            })
                ->paginate($perPage);
            $logController->createLog(__METHOD__, 'success', 'Fetched Role Index Data.', auth()->user(), '');

            return view('role.index', compact('roles', 'perPage'));

        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function add(LogsController $logController)
    {
        try {
            $permissions = Permission::all()->groupBy('group_by');
            $logController->createLog(__METHOD__, 'success', 'Rendering Add View for Role.', auth()->user(), '');

            return view('role.add', compact('permissions'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request, LogsController $logController)
    {
        try {
            $request->validate([
                'title' => 'required',
                'permissions' => 'required',
            ]);

            $role = Role::create([
                'title' => $request->title,
            ]);

            foreach ($request->permissions as $permission) {
                PermissionRoles::create([
                    'role_id' => $role->id,
                    'permission_id' => $permission,
                ]);
            }
            $logController->createLog(__METHOD__, 'success', 'Role Created.', auth()->user(), '');

            return redirect()->to('/role')->with('success', 'New Record Created SuccessFully!');
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Role $role, LogsController $logController)
    {
        try {
            $role = Role::where('id', $role->id)->first();
            $permissions = Permission::all()->groupBy('group_by');
            $role_permissions = PermissionRoles::where('role_id', $role->id)->get()->pluck('permission_id')->toArray();
            $logController->createLog(__METHOD__, 'success', 'Editing Role.', auth()->user(), '');

            return view('role.edit', compact('role', 'permissions', 'role_permissions'));
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Role $role, Request $request, LogsController $logController)
    {
        try {

            $request->validate([
                'title' => 'required',
                'permissions' => 'required',
            ]);

            $roles = Role::where('id', $role->id)->update([
                'title' => $request->title,
            ]);

            PermissionRoles::where('role_id', $role->id)->delete();

            foreach ($request->permissions as $permission) {
                PermissionRoles::create([
                    'role_id' => $role->id,
                    'permission_id' => $permission,
                ]);
            }
            $logController->createLog(__METHOD__, 'success', 'Edited Role', auth()->user(), json_encode($role));

            return redirect()->to('/role')->with('success', 'Record Updated SuccessFully!');
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', 'Error on Edited Role', auth()->user(), json_encode($role));

            // dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $role = Role::find($id);
            $role->delete();

            $role_permissions = PermissionRoles::where('role_id', $id)->delete();

            return redirect()->back()->with('success', 'Record Deleted Succesfully!');
        } catch (Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
