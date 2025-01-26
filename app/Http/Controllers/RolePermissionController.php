<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RolePermissionController extends Controller
{
    public function show()
    {
        return view('role_permission.index');
    }

    /**
     * @throws Exception
     */
    public function list()
    {
        $RolePermission = Permission::all();
        return datatables()->of($RolePermission)
            ->setRowAttr([
                'align'=>'center',
            ])
            ->make(true);
    }

    public function create()
    {
        return view('role_permission.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:45',
        ]);

        Permission::query()->create([
            'name' => $validated['name'],
        ]);

        Session::flash('success', 'Pemission Created Successfully!');
        return redirect()->route('role_permission.show');
    }

    public function edit($id)
    {
        $permission = Permission::query()->where('id', $id)->first();
              
        return view('role_permission.edit', compact('permission'));
    }

    public function update(Request $request, $userTypeId): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:45',
        ]);

        $userType = Permission::query()->where('id', $userTypeId)->first();
        if(!empty($userType)) {
            $userType->update([
                'name' => $validated['name'],
            ]);
        }

        Session::flash('success', 'Permission Updated Successfully!');
        return redirect()->route('role_permission.show');
    }

    public function delete(Request $request): JsonResponse
    {
        // dd($request->id);
        $brand = Permission::query()->where('id', $request->userTypeId)->first();
        // dd($brand);
        if(!empty($brand)) {
            $brand->role_permission()->delete();
            $brand->delete();
        }
        return response()->json();
    }
}
