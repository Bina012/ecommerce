<?php

namespace App\Http\Middleware;

use App\Models\permission;
use App\Models\role;
use Closure;
use Illuminate\Http\Request;

class CheckPermision
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role = role::find(auth()->user()->role_id);

        $current_page_route = $request->route()->getName();
        $permission = permission::where('route',$current_page_route)->first();
        if ($permission){
            $permission_grant = $role->permissions()->where('permission_id',$permission->id)->first();
           if (!$permission_grant){
               //abort(403);
           }
        } else {
          // abort(403);
        }

        return $next($request);
    }
}
