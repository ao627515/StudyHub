<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        try {
            // Authentifier l'utilisateur
            $token = $request->authenticate(true); // true pour indiquer que c'est une requête API

            // Répondre avec le token et un message de succès
            return response()->json([
                'status' => 'success',
                'message' => trans('auth.login.success'),
                'data' => [
                    'token' => $token,
                ],
                'errors' => null,
            ], Response::HTTP_OK);
        } catch (\Exception $ex) {
            // Gérer les erreurs d'authentification
            return response()->json([
                'status' => 'error',
                'message' => trans('auth.failed'),
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage(),
                ],
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            Auth::guard('web')->logout();

            // Invalider la session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $request->user()->currentAccessToken()->delete();

            // Répondre avec un message de succès
            return response()->json([
                'status' => 'success',
                'message' => trans('auth.logout.success'),
                'data' => null,
                'errors' => null,
            ], Response::HTTP_OK);
        } catch (\Exception $ex) {
            // Gérer les erreurs lors de la déconnexion
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to log out.',
                'data' => null,
                'errors' => [
                    'exception' => $ex->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
