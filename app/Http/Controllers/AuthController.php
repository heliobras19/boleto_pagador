<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\ResponseAPI;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    private $response;
    public function __construct(ResponseAPI $responseAPI)
    {
        $this->response = $responseAPI;
            $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $loginRequest)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request, RegisterRequest $registerRequest){

        $data = $request->all();
        User::create([
            'name' => $data['name'],
            'sobrenome' => $data['sobrenome'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $this->response->sucess($data);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, array $data = [])
    {
        return response()->json([
            'data' => $data,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 10 //expirar em 10 minutos
        ]);
    }
}
