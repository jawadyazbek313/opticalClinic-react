<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $user = User::find(Auth::user()->id );
        if (! $user->hasRole('admin')) {
            return abort(401);
        }
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionsRequest $request)
    {
        $user = User::find(Auth::user()->id );
        if (! $user->hasRole('admin')) {
            return abort(401);
        }
        Permission::create($request->all());

        return redirect()->route('permissions.index');
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $user = User::find(Auth::user()->id );
        if (! $user->hasRole('admin')) {
            return abort(401);
        }

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionsRequest $request, Permission $permission)
    {
        $user = User::find(Auth::user()->id );
        if (! $user->hasRole('admin')) {
            return abort(401);
        }

        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $user = User::find(Auth::user()->id );
        if (! $user->hasRole('admin')) {
            return abort(401);
        }

        $permission->delete();

        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission)
    {
        $user = User::find(Auth::user()->id );
        if (! $user->hasRole('admin')) {
            return abort(401);
        }

        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
