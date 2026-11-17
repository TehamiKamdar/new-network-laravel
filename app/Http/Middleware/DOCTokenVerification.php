<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DOCTokenVerification
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('token');

        if (!$token) {
            return response()->json([
                'status' => 401,
                'success' => false,
                'message' => 'Token is missing'
            ], 401);
        }

        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json([
                'status' => 401,
                'success' => false,
                'message' => 'Unauthorized Access'
            ], 401);
        }

        // Attach user to request so controllers can access it
        $request->merge(['doc_user' => $user]);

        return $next($request);
    }
}
