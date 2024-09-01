<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var \App\Models\User $user
         */
        $user = $request->user();
        abort_if(!$user->hasAnyRole(Role::all()), 404);
        // abort_if(!$user->hasRole([
        //     \App\Enums\Roles\RoleEnum::SUPER,
        //     \App\Enums\Roles\RoleEnum::ADMIN,
        // ]), 404);

        return $next($request);
    }
}
