<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {
        try {
            $data = $request->all();
            $user = User::where('email', $data['email'])->first();
            $user->password = Hash::make($data['password']);
            if (Auth::attempt($data)) {

                $user->tokens()->where('name', $user->email)->delete();

                return response()->json([
                    'status' => true,
                    'message' => __('main.logged_in'),
                    'token' => $user->createToken($user->email)->plainTextToken,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => __('main.wrong_password'),
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => 'Ok',
            'message' => __('main.logged_out')
        ]);
    }
}
