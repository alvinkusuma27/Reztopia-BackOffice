<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function index()
    {
        try {
            $data = Cart::where('id_user', Auth::user()->id)->get();
            if (!empty($data[0])) {
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Successfully fetch data'
                    ],
                    'data' => $data
                ], 200);
            } else {

                return response()->json([
                    'meta' => [
                        'status' => 'failed',
                        'message' => 'Data Not Found'
                    ]
                ], 404);
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
    public function addCart(Request $request)
    {
        // dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'id_outlet' => 'required',
                'id_user' => 'required',
                'id_product' => 'required',
                'quantity' => 'required|integer',
                'type_order' => 'required|in:dine_in,take_away',
            ], [
                'type_order.in' => 'order type only dine in and take away'
            ]);
            if (!$validator->fails()) {
                $check_cart_product = Cart::where('id_user', Auth::user()->id)->get();
                // dd('ua', $check_cart_product);
                if (empty($check_cart_product[0])) {
                    // dd('ua');
                    $cart = new Cart();
                    $cart->id_product = $request->id_product;
                    $cart->id_user = $request->id_user;
                    $cart->id_outlet = $request->id_outlet;
                    $cart->quantity = $request->quantity;
                    $cart->type_order = $request->type_order;
                    $cart->note = $request->note;
                    $cart->created_at = Carbon::now();
                    $cart->save();
                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Success add data'
                        ]
                    ], 200);
                } elseif ($check_cart_product[0]->id_product == $request->id_product) {
                    // $id_product = $check_cart_product[0]->id_product;
                    // $id_cart = $check_cart_product[0]->id;
                    // dd('oni');
                    // dd('ya');
                    $note = Cart::findOrFail($check_cart_product[0]->id);
                    $note->update([
                        'quantity' => $check_cart_product[0]->quantity + 1,
                        'note' => $request->note,
                        'type_order' => $request->type_order
                    ]);
                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Success update data'
                        ]
                    ], 200);
                } else {
                    $cart = new Cart();
                    $cart->id_product = $request->id_product;
                    $cart->id_user = $request->id_user;
                    $cart->id_outlet = $request->id_outlet;
                    $cart->quantity = $request->quantity;
                    $cart->type_order = $request->type_order;
                    $cart->note = $request->note;
                    $cart->created_at = Carbon::now();
                    $cart->save();
                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Success add data'
                        ]
                    ], 200);
                }
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'failed',
                        'message' => 'Bad Request'
                    ],
                    'data' => $validator->messages()->all()
                ], 400);
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

    public function addNote(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'note' => 'required',
                'id_product' => 'required'
            ]);

            // $id_user = Auth::user()->id;

            // dd($request->all());
            if (!$validator->fails()) {
                $cart = Cart::where('id_user', Auth::user()->id)
                    ->where('id_product', $request->id_product)
                    ->get();
                $id = $cart[0]->id;
                $note = Cart::findOrFail($id);
                // dd($note);
                $note->update([
                    'note' => $request->note
                ]);

                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Success add note'
                    ]
                ], 200);
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'failed',
                        'message' => 'Bad Request'
                    ],
                    'data' => $validator->messages()->all()
                ], 400);
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

    public function quantity(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'id_product' => 'required'
            ]);
            if (!$validator->fails()) {
                $check_cart_product = Cart::where('id_user', Auth::user()->id)
                    ->where('id_product', $request->id_product)
                    ->get();
                $note = Cart::findOrFail($check_cart_product[0]->id);
                if ($request->min) {
                    if ($check_cart_product[0]->quantity > 1) {
                        $note->update([
                            'quantity' => $check_cart_product[0]->quantity - 1
                        ]);
                        return response()->json([
                            'meta' => [
                                'status' => 'success',
                                'message' => 'Success add quantity'
                            ]
                        ], 200);
                    }
                    $note->delete();
                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Success Delete Product'
                        ]
                    ], 200);
                } elseif ($request->plus) {
                    $note->update([
                        'quantity' => $check_cart_product[0]->quantity + 1
                    ]);
                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Success add quantity'
                        ]
                    ], 200);
                }
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'failed',
                        'message' => 'Bad Request'
                    ],
                    'data' => $validator->messages()->all()
                ], 400);
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
}
