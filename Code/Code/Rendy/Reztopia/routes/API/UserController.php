<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    // use HasApiTokens;
    use HasApiTokens;

    public function login(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (!$validator->fails()) {

                $credentials = request(['email', 'password']);
                if (!Auth::attempt($credentials)) {
                    return response()->json([
                        'meta' => [
                            'message' => 'Authentication Failed'
                        ]
                    ], 500);
                }

                if (Auth::user()->roles != 'mahasiswa') {
                    Auth::logout();
                    return response()->json([
                        'meta' => [
                            'message' => 'User roles are not allowed'
                        ]
                    ], 400);
                }

                $user = User::where('email', $request->email)->first();
                if (!Hash::check($request->password,  $user->password, [])) {
                    throw new \Exception('Invalid Credentials');
                }

                $tokenResult = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'meta' => [
                        'access_token' => $tokenResult,
                        'token_type' => 'Bearer',
                    ],
                    'data' => $user
                ], 200);
            }

            return response()->json([
                'meta' => [
                    'status' => 'Failed',
                    'message' => 'Bad Requst'
                ],
                'data' => $validator->messages()->all()
            ], 400);
        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|min:8'
            ]);

            if (!$validator->fails()) {

                if (!User::where('email', $request->email)->first()) {
                    User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'roles' => 'mahasiswa'
                    ]);

                    $user = User::where('email', $request->email)->first();

                    $tokenResult = $user->createToken('authToken')->plainTextToken;


                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                        ],
                        'data' => [
                            'access_token' => $tokenResult,
                            'token_type' => 'Bearer',
                            'user' =>  $user
                        ]
                    ], 201);
                }

                return response()->json([
                    'meta' => [
                        'status' => 'error',
                        'message' => 'E-mail already in use'
                    ]
                ], 400);
            }
            return response()->json([
                'meta' => [
                    'status' => 'Failed',
                    'message' => 'Bad Requst'
                ],
                'data' => $validator->messages()->all()
            ], 400);
        } catch (Exception $error) {

            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => $error
                ],
                'data' => $error->getMessage()
            ], 200);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return response()->json([
            'meta' => [
                'message' => 'Token Revoked'
            ],
            'data' => $token
        ], 200);
    }

    public function fetch(Request $request)
    {
        return response()->json([
            'meta' => [
                'message' => 'Data Profile user successfully fetch'
            ],
            'data' => $request->user()
        ]);
    }

    public function updateUser(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $user->update($data);

        return response()->json([
            'meta' => [
                'status' => 'success',
                'message' => 'Profile Updated'
            ],
            'data' => $user
        ], 200);
    }

    public function tes()
    {
        $user = User::all();
        return response()->json([
            'meta' => [
                'success' => true,
                'message' => 'data berhasil diambil',
            ],
            'data' => $user,
        ], 200);
    }
}
