<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        $userType = $request->header('X-User-Type');

        if (!$userType) {
            if ($userId = $request->header('X-User-Id')) {
                $user = User::find($userId);
                if ($user) {
                    Auth::setUser($user); 
                }
            } 
            
            if (!request()->user()) {
                return response()->json(['message'=>'Unauthenticated'], 401);
            }
            $userType = $request->user()->user_type_id;
        }

        if (!in_array($userType, $types)) {
            return response()->json(['message'=>'Unauthorised'], 403);
        }
            
        return $next($request);
    }
}
