<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class BattleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user1 = User::find($request->route('userId1'));
        $user2 = User::find($request->route('userId2'));

        if ($user1->life_points == 0 || $user2->life_points == 0) {
            return response()->json(["message" => 'Um ou mais persoangem está sem vida.']);
        }

        $response = $next($request);
        return $response;
    }
}
