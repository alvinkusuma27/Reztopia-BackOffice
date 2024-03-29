<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    // use HasApiTokens;
    use HasApiTokens;

    public function login(Request $request)
    {

        // return response()->json([
        //     'data' => $request->all()
        // ], 200);
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
                    ], 401);
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

            // return ResponseFormatter::success([
            //     'access_token' => $tokenResult,
            //     'token_type' => 'Bearer',
            //     'user' => $user
            // ], 'Authenticated');
        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
            // return ResponseFormatter::error([
            //     'message' => 'Something went wrong',
            //     'error' => $error
            // ], 'Authenticated', 500);
        }
    }

    public function register(Request $request)
    {
        try {
            // $request->validate([
            //     'name' => ['required|string|max:255'],
            //     'email' => ['required|string|email|max:255'],
            //     'password' => ['required|min:8']
            // ]);

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

            // return ResponseFormatter::success([
            //     'access_token' => $tokenResult,
            //     'token_type' => 'Bearer',
            //     'user' =>  $user
            // ]);
        } catch (Exception $error) {

            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => $error
                ],
                'data' => $error->getMessage()
            ], 200);
            // return ResponseFormatter::error([
            //     'message' => 'Something went wrong',
            //     'error' => $error
            // ], 'Authentication Failed', 500);
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
        // return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function fetch(Request $request)
    {
        return response()->json([
            'meta' => [
                'message' => 'Data Profile user successfully fetch'
            ],
            'data' => $request->user()
        ]);
        // return ResponseFormatter::success($request->user(), 'Data Profile user successfully fetch');
    }

    public function updateUser(Request $request)
    {

        try {

            $user = Auth::user()->where('roles', 'mahasiswa')
                ->where('id', (int) $request->id)
                ->first();

            if (!$request->hasFile('image')) {
                $validator = Validator::make($request->all(), [
                    // 'image' => 'image|mimes:png,jpg,jpg|max:2048',
                    'phone' => 'min:10',
                    'email' => 'email'
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'meta' => [
                            'status' => 'failed',
                            'message' => 'Bad Request'
                        ],
                        'data' => $validator->messages()->all()
                    ], 400);
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'image' => 'required|image|mimes:png,jpg,jpg|max:2048',
                    'phone' => 'min:10',
                    'email' => 'email'
                ]);


                if ($validator->fails()) {
                    return response()->json([
                        'meta' => [
                            'status' => 'failed',
                            'message' => 'Bad Request'
                        ],
                        'data' => $validator->messages()->all()
                    ], 400);
                }

                $image = $request->file('image');
                $image_name = time() . '-user-update-' . $request->name . '.' . $image->getClientOriginalExtension();
                Storage::putFileAs('public/uploads/user/', $image, $image_name);
                $user->image = $image_name;
            }



            $user->name = $request->name;
            $user->phone = $request->phone;
            if (User::where('email', '!=', $request->email)->first()) {
                $user->email = $request->email;
            }
            // $user->password = Hash::make($request->password);
            $user->save();

            // $user->update($data);


            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'message' => 'Profile Updated'
                ],
                'data' => $user
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
        // return ResponseFormatter::success($user, 'Profile Updated');
    }

    public function changePassword(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8',
                'password_old' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'meta' => [
                        'status' => 'failed',
                        'message' => 'Bad Request'
                    ],
                    'data' => $validator->messages()->all()
                ], 400);
            }


            $user = Auth::user()->where('roles', 'mahasiswa')
                ->where('id', (int) $request->id)
                ->first();

            if (!Hash::check($request->password_old, $user->password)) {
                return response()->json([
                    'message' => "Password is wrong",
                ], 400);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'message' => 'Password Updated'
                ],
            ], 200);
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

    public function checkToken(Request $request)
    {
        try {
            $token = $request->header('Authorization');
            if ($token) {
                $accessToken = str_replace('Bearer ', '', $token);

                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Token found'
                    ],
                    'token' => $accessToken
                ], 200);
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Token not Found'
                    ],
                ], 401);
            }
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

    // public function tes()
    // {
    //     $user = User::all();
    //     // return ResponseFormatter::success([
    //     //     'data' => $user
    //     // ]);
    //     // $data = Auth::user()->name;
    //     return response()->json([
    //         'meta' => [
    //             'success' => true,
    //             'message' => 'data berhasil diambil',
    //         ],
    //         'data' => $user,
    //     ], 200);
    // }
}
