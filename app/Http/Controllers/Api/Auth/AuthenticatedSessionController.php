<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\ResponseResource;
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
    public function store(LoginRequest $request)
    {
        try {
            // Authentifier l'utilisateur
            $token = $request->authenticate(true); // true pour indiquer que c'est une requête API

            // Répondre avec le token et un message de succès
            return new ResponseResource(
                message: trans('auth.login.success'),
                data: ['token' => $token],
            );
        } catch (\Exception $ex) {
            // Gérer les erreurs d'authentification
            return (new ErrorResponseResource(
                message: trans('auth.failed'),
                errors: ['exception' => $ex->getMessage()],
            ))->response()->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        try {
            Auth::guard('web')->logout();

            // Invalider la session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $request->user()->currentAccessToken()->delete();

            // Répondre avec un message de succès
            return new ResponseResource(
                message: trans('auth.logout.success')
            );
        } catch (\Exception $ex) {
            // Gérer les erreurs lors de la déconnexion

            return (new ErrorResponseResource(
                message: 'Failed to log out.',
                errors: ['exception' => $ex->getMessage()],
            ))->response()->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function fail()
    {
        return (new ErrorResponseResource(
            message: 'you are not login',
        ))->response()->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }
}
