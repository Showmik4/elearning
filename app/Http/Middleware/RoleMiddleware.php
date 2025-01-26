<?php
namespace App\Http\Middleware;
use App\Models\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $requiredPermission)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userRoleId = $user->fkUserTypeId;

        // Check if the user's role has the required permission
        $hasPermission = \DB::table('role_permission')
            ->where('role_id', $userRoleId)
            ->where('permission_id', function ($query) use ($requiredPermission) {
                $query->select('id')
                    ->from('permissions')
                    ->where('name', $requiredPermission)
                    ->limit(1);
            })
            ->exists();

        if ($hasPermission) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Unauthorized!');
    }

}
