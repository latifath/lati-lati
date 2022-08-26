<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Gestionnaire
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
        $user = $request->user();

        if($user && ($user->role === "gestionnaire" || $user->role === "admin" )){

            return $next($request);
        }

        return redirect()->route('root_espace_admin_index');    }
}
