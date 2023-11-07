<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserAccount;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roleid = session('roleid');
        $roleIdsArray = explode(',', $roleid);
        //dd(in_array('9', $roleIdsArray));
        if (
            (in_array('1', $roleIdsArray)) || (in_array('2', $roleIdsArray)) || (in_array('3', $roleIdsArray)) || (in_array('9', $roleIdsArray)) || (in_array('10', $roleIdsArray)) || (in_array('11', $roleIdsArray)) || (in_array('4', $roleIdsArray))
        ) {
            return $next($request);
        }

        //dd($roleid);

        //$user = Auth::user();
        // dd($user);
        // if ($user && $user->role === 'admin') {
        //     return $next($request); // User is an admin, allow access
        // }

        //abort(403, 'Unauthorized.');
        Auth::logout();
        return redirect('logout');
    }
}
