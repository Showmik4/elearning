<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserType;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserTypeController extends Controller
{
    public function show()
    {
        return view('userType.index');
    }

    /**
     * @throws Exception
     */
    public function list()
    {
        $userType = UserType::all();
        return datatables()->of($userType)
            ->setRowAttr([
                'align'=>'center',
            ])
            ->make(true);
    }

    public function create()
    {
        return view('userType.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'typeName' => 'required|string|max:45',
        ]);

        UserType::query()->create([
            'typeName' => $validated['typeName'],
        ]);

        Session::flash('success', 'UserType Created Successfully!');
        return redirect()->route('userType.show');
    }

    public function edit($userTypeId)
    {
        $userType = UserType::query()->where('userTypeId', $userTypeId)->first();
        $permissions=Permission::all();
        $rolePermission=RolePermission::query()->where('role_id', $userType->userTypeId)->get();
        return view('userType.edit', compact('userType','permissions','rolePermission'));
    }

    public function update(Request $request, $userTypeId): RedirectResponse
    {
        $validated = $this->validate($request, [
            'typeName' => 'required|string|max:45',
        ]);

        $userType = UserType::query()->where('userTypeId', $userTypeId)->first();
        if(!empty($userType)) {
            $userType->update([
                'typeName' => $validated['typeName'],
            ]);
        }

        Session::flash('success', 'UserType Updated Successfully!');
        return redirect()->route('userType.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $userType = UserType::query()->where('userTypeId', $request->userTypeId)->first();   
        $user = User::where('fkUserTypeId', $userType->userTypeId)->first();    
        if ($user) {           
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete this User Type because it is associated with users.'
            ], 400);
        }    
        if ($userType) {           
            User::query()->where('fkUserTypeId', $userType->userTypeId)->update([
                'fkUserTypeId' => null,
            ]);   
            $userType->rolepermission()->delete();
            $userType->delete();
        }    
        return response()->json([
            'success' => true,
            'message' => 'User Type deleted successfully.'
        ]);
    }
    

    // public function role_update(Request $request)
    // {
    //     $roleId = $request->input('role_id');
    //     $selectedPermissions = $request->input('permission_id', []);
    
      
    //     $existingPermissions = RolePermission::where('role_id', $roleId)->pluck('permission_id')->toArray();
    
       
    //     $newPermissions = array_diff($selectedPermissions, $existingPermissions);
    
       
    //     foreach ($newPermissions as $permissionId) {
    //         RolePermission::create([
    //             'role_id' => $roleId,
    //             'permission_id' => $permissionId,
    //         ]);
    //     }
    
      
    //     $uncheckedPermissions = array_diff($existingPermissions, $selectedPermissions);
    
        
    //     RolePermission::where('role_id', $roleId)
    //         ->whereIn('permission_id', $uncheckedPermissions)
    //         ->delete();
    
    //     return redirect()->route('userType.show')->with('success', 'Permissions updated successfully');
    // }

    public function role_update(Request $request)
    {
        $roleId = $request->input('role_id');
        $selectedPermissions = $request->input('permission_id', []);          
        $existingPermissions = RolePermission::where('role_id', $roleId)->pluck('permission_id')->toArray();       
        $newPermissions = array_diff($selectedPermissions, $existingPermissions);    
        foreach ($newPermissions as $permissionId) {
            RolePermission::create([
                'role_id' => $roleId,
                'permission_id' => $permissionId,
            ]);
        }           
        $uncheckedPermissions = array_diff($existingPermissions, $selectedPermissions);   
        RolePermission::where('role_id', $roleId)
            ->whereIn('permission_id', $uncheckedPermissions)
            ->delete();    
        return redirect()->route('userType.show')->with('success', 'Permissions updated successfully');
    }    
    
}
