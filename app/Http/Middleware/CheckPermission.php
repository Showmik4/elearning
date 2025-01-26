<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Get roles associated with the user's type dynamically
        $allowedRoles = $user->userType->rolepermission->pluck('role_id')->toArray(); // Assuming role_id exists in role_permission

        // Check if the user has one of the allowed roles
        if (empty($allowedRoles) || !in_array($user->fkUserTypeId, $allowedRoles)) {
            return redirect()->back()->with('error', 'Unauthorized role!');
        }

        // Get the current route name (this will be used as the permission name)
        $routeName = $request->route()->getName(); // e.g., 'contact.show'

        // Assuming permission names match route names
        $permissionName = $routeName;

        // Get the user's permissions
        $permissions = $user->userType->permissions->pluck('name')->toArray();

        // Check if the user has the required permission
        if (!in_array($permissionName, $permissions)) {
            return redirect()->back()->with('error', 'Permission Denied!');
        }

        return $next($request);
    }

}
