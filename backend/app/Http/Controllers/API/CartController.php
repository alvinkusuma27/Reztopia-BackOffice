<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order_detail;
use App\Models\Order_status;
use App\Models\Orders;
use App\Models\Products;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function index()
    {
        try {
            // $data = Cart::where('id_user', Auth::user()->id)->get();
            $data = DB::table('order_details as od')
                ->select(
                    'od.id',
                    'p.id as id_product',
                    'o.id as id_order',
                    'p.name as product_name',
                    'p.price_final',
                    'od.note',
                    'od.quantity',
                    'p.image',
                    'u.name as nama_pemesan',
                    'o.order_type',
                    'o.table_number',
                    'ol.name as outlet_name',
                    'o.total',
                )
                ->where('os.name', 'cart')
                ->where('o.id_user', Auth::user()->id)
                ->join('products as p', 'od.id_product', '=', 'p.id')
                ->join('orders as o', 'o.id', '=', 'od.id_order')
                ->join('users as u', 'u.id', '=', 'o.id_user')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->join('outlets as ol', 'ol.id', '=', 'o.id_outlet')
                ->get();

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
                // 'id_user' => 'required',
                'id_product' => 'required',
                // 'quantity' => 'required|integer',
                'order_type' => 'required|in:dine_in,take_away',
            ], [
                'order_type.in' => 'order type only dine in and take away'
            ]);
            if (!$validator->fails()) {
                // $check_cart_product = Cart::where('id_user', Auth::user()->id)->get();


                $check_cart = DB::table('order_details as od')
                    ->where('os.name', 'cart')
                    ->where('o.id_user', Auth::user()->id)
                    ->join('orders as o', 'o.id', '=', 'od.id_order')
                    ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                    ->get();
                // dd('ua', $check_cart);

                $uniqid =
                    floor(time() - 999999999);

                if (empty($check_cart[0])) {
                    $product = Products::select('id_category', 'price_final')->where('id', $request->id_product)->first();
                    $order = new Orders();
                    $order->id = $uniqid;
                    $order->id_user = Auth::user()->id;
                    $order->order_type = $request->order_type;
                    $order->id_order_status = 3;
                    $order->id_category = $product->id_category;
                    $order->id_outlet = $request->id_outlet;
                    $order->save();

                    $cart = new Order_detail();
                    $cart->id_order = $order->id;
                    $cart->id_product = $request->id_product;
                    $cart->quantity = 1;
                    $cart->price = $product->price_final;
                    // $cart->type_order = $request->type_order;
                    $cart->note = $request->note;
                    $cart->save();

                    $order_update = Orders::findOrFail($order->id);
                    $order_update->update([
                        'total' => $product->price_final * $cart->quantity
                    ]);

                    // $cart->
                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Success add data'
                        ]
                    ], 200);
                } else {
                    $check_cart_product = DB::table('order_details as od')
                        ->select('p.price_final', 'o.id', 'od.id_product', 'od.id as id_order_details', 'od.quantity')
                        ->where('os.name', 'cart')
                        ->where('od.id_product', $request->id_product)
                        ->where('o.id_user', Auth::user()->id)
                        ->join('products as p', 'p.id', '=', 'od.id_product')
                        ->join('orders as o', 'o.id', '=', 'od.id_order')
                        ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                        ->get();
                    // dd($check_cart_product);
                    if (!empty($check_cart_product[0])) {
                        // $id_product = $check_cart_product[0]->id_product;
                        // $id_cart = $check_cart_product[0]->id;
                        // dd('oni');
                        // dd('ya');
                        // $check_id_order = DB::table('order_details as od')
                        //     ->select('o.id')
                        //     ->where('os.name', 'cart')
                        //     ->where('o.id_user', Auth::user()->id)
                        // ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                        //     ->join('orders as o', 'o.id', '=', 'od.id_order')
                        //     ->get();
                        // dd($check_cart_product[0]);

                        $note = Order_detail::findOrFail($check_cart_product[0]->id_order_details);
                        // dd($note);
                        $note->update([
                            'quantity' => $check_cart_product[0]->quantity + 1,
                            'note' => $request->note,
                            // 'type_order' => $request->type_order
                        ]);

                        // $order_update = Orders::findOrFail($check_cart_product[0]->id);
                        // $order_update->update([
                        //     'total' => $check_cart_product[0]->price_final * $check_cart_product[0]->quantity
                        // ]);
                        $cek = Order_detail::with('product')->where('id_order', $check_cart_product[0]->id)->get();
                        $total_mentah = array();
                        foreach ($cek as $item) {
                            $total_count = $item->quantity *  $item->product[0]->price_final;
                            array_push($total_mentah, $total_count);
                        }
                        $total = array_sum($total_mentah);

                        $order_update = Orders::findOrFail($check_cart_product[0]->id);
                        $order_update->update([
                            'total' => $total
                        ]);

                        return response()->json([
                            'meta' => [
                                'status' => 'success',
                                'message' => 'Success update data'
                            ]
                        ], 200);
                    } else {
                        // $cart = new Cart();
                        // $cart->id_product = $request->id_product;
                        // $cart->id_user = $request->id_user;
                        // $cart->id_outlet = $request->id_outlet;
                        // $cart->quantity = $request->quantity;
                        // $cart->type_order = $request->type_order;
                        // $cart->note = $request->note;
                        // $cart->created_at = Carbon::now();
                        // $cart->save();
                        $check_id_order = DB::table('order_details as od')
                            ->select('o.id', 'p.price_final', 'od.quantity')
                            ->where('os.name', 'cart')
                            ->where('o.id_user', Auth::user()->id)
                            ->join('orders as o', 'o.id', '=', 'od.id_order')
                            ->join('products as p', 'p.id', '=', 'od.id_product')
                            ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                            ->get();
                        // $id_order = $check_id_order[0]->id;
                        // dd($id_order);


                        // $product = Products::select('id_category')->where('id', $request->id_product)->first();
                        // dd($product);

                        // $order = new Orders();
                        // $order->id_user = Auth::user()->id;
                        // // $order->order_type = $request->type_order;
                        // $order->id_order_status = 3;
                        // $order->id_category = $product->id_category;
                        // $order->save();

                        $cart = new Order_detail();
                        $cart->id_order = $check_id_order[0]->id;
                        $cart->id_product = $request->id_product;
                        $cart->quantity = 1;
                        // $cart->type_order = $request->type_order;
                        $cart->note = $request->note;
                        $cart->save();
                        // $check_order = Orders::where('id', $check_id_order[0]->id)->get();
                        $cek = Order_detail::with('product')->where('id_order', $check_id_order[0]->id)->get();
                        // dd($cek);

                        $total_mentah = array();
                        foreach ($cek as $item) {
                            $total_count = $item->quantity *  $item->product[0]->price_final;
                            array_push($total_mentah, $total_count);
                        }
                        $total = array_sum($total_mentah);

                        $order_update = Orders::findOrFail($check_id_order[0]->id);
                        $order_update->update([
                            'total' => $total
                        ]);

                        return response()->json([
                            'meta' => [
                                'status' => 'success',
                                'message' => 'Success add data'
                            ]
                        ], 200);
                    }
                    // if ($check_cart_product[0]->id_product == $request->id_product)
                }
                // }
                // if (empty($check_cart_product[0])) {
                //     // dd('ua');
                //     // $cart = new Cart();
                //     // $cart->id_product = $request->id_product;
                //     // $cart->id_user = Auth::user()->id;
                //     // $cart->id_outlet = $request->id_outlet;
                //     // $cart->quantity = $request->quantity;
                //     // $cart->type_order = $request->type_order;
                //     // $cart->note = $request->note;
                //     // $cart->created_at = Carbon::now();
                //     // $cart->save();


                // } else

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
                $check_id_order_details = DB::table('order_details as od')
                    ->select('od.id')
                    ->where('os.name', 'cart')
                    ->where('od.id_product', $request->id_product)
                    ->where('o.id_user', Auth::user()->id)
                    ->join('orders as o', 'o.id', '=', 'od.id_order')
                    ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                    ->get();
                // dd($check_id_order_details);
                // $cart = Cart::where('id_user', Auth::user()->id)
                //     ->where('id_product', $request->id_product)
                //     ->get();
                // $id = $cart[0]->id;
                // $note = Cart::findOrFail($id);
                $note = Order_detail::findOrFail($check_id_order_details[0]->id);
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
                $check_id_order_details = DB::table('order_details as od')
                    ->select('od.id', 'od.quantity', 'o.id as id_order')
                    ->where('os.name', 'cart')
                    ->where('od.id_product', $request->id_product)
                    ->where('o.id_user', Auth::user()->id)
                    ->join('orders as o', 'o.id', '=', 'od.id_order')
                    ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                    ->get();
                // dd($check_id_order_details);
                if (empty($check_id_order_details[0])) {
                    return response()->json([
                        'meta' => [
                            'status' => 'Error',
                            'message' => 'Data Not Found'
                        ]
                    ], 404);
                };
                // $cart = Cart::where('id_user', Auth::user()->id)
                //     ->where('id_product', $request->id_product)
                //     ->get();
                // $id = $cart[0]->id;
                // $note = Cart::findOrFail($id);
                $quantity = Order_detail::findOrFail($check_id_order_details[0]->id);
                if ($request->min) {
                    if ($check_id_order_details[0]->quantity > 1) {
                        $quantity->update([
                            'quantity' => $check_id_order_details[0]->quantity - 1
                        ]);

                        $cek = Order_detail::with('product')->where('id_order', $check_id_order_details[0]->id_order)->get();
                        // dd($cek);

                        $total_mentah = array();
                        foreach ($cek as $item) {
                            $total_count = $item->quantity *  $item->product[0]->price_final;
                            array_push($total_mentah, $total_count);
                        }
                        $total = array_sum($total_mentah);

                        $order_update = Orders::findOrFail($check_id_order_details[0]->id_order);
                        $order_update->update([
                            'total' => $total
                        ]);

                        return response()->json([
                            'meta' => [
                                'status' => 'success',
                                'message' => 'Success reduce quantity'
                            ]
                        ], 200);
                    }
                    $quantity->delete();
                    $cek = Order_detail::with('product')->where('id_order', $check_id_order_details[0]->id_order)->get();
                    // dd($cek);

                    $total_mentah = array();
                    foreach ($cek as $item) {
                        $total_count = $item->quantity *  $item->product[0]->price_final;
                        array_push($total_mentah, $total_count);
                    }
                    $total = array_sum($total_mentah);

                    $order_update = Orders::findOrFail($check_id_order_details[0]->id_order);
                    $order_update->update([
                        'total' => $total
                    ]);

                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Success Delete Product'
                        ]
                    ], 200);
                } elseif ($request->plus) {
                    $quantity->update([
                        'quantity' => $check_id_order_details[0]->quantity + 1
                    ]);
                    $cek = Order_detail::with('product')->where('id_order', $check_id_order_details[0]->id_order)->get();
                    // dd($cek);

                    $total_mentah = array();
                    foreach ($cek as $item) {
                        $total_count = $item->quantity *  $item->product[0]->price_final;
                        array_push($total_mentah, $total_count);
                    }
                    $total = array_sum($total_mentah);

                    $order_update = Orders::findOrFail($check_id_order_details[0]->id_order);
                    $order_update->update([
                        'total' => $total
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

    public function checkout(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'id_order' => 'required',
                // 'proof_of_payment' => 'required',
                'order_type' => 'required|in:dine_in,take_away',
                // 'payment_code' => 'required',
                'table_number' => 'required',
            ]
        );


        if ($validator->fails()) {
            return response()->json([
                'meta' => [
                    'status' => 'failed',
                    'message' => 'Bad Request'
                ],
                'data' => $validator->messages()->all()
            ], 400);
        }
        // dd(Carbon::now()->timestamp);

        $check_order = Orders::where('id', $request->id_order)->first();
        if (empty($check_order) == true) {
            return response()->json([
                'meta' => [
                    'status' => 'failed',
                    'message' => 'Order Not Found'
                ],
            ], 404);
        } else {
            $order = Orders::findOrFail($request->id_order);
            $order->update([
                'payment_method' => $request->payment_method,
                'table_number' => $request->table_number,
                'order_type' => $request->order_type,
                'payment_code' => $request->payment_code,
                'date_order' => Carbon::now(),
                'time_order' => Carbon::now()->timestamp,
                'id_order_status' => 4
            ]);

            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isDSanitized');
            Config::$is3ds = config('services.midtrans,is3ds');

            $transaction = Orders::with('user')->find($request->id_order);
            // dd(config('services.midtrans'));
            $midtrans = [
                'transaction_details' => [
                    'order_id' => $request->id_order,
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => [
                    'first_name' => $transaction->user[0]->name,
                    'email' => $transaction->user[0]->email
                ],
                'enabled_payments' => ['gopay', 'bank_transfer', 'credit_card'],
                'vtweb' => []
            ];


            try {
                $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
                $transaction->payment_url = $paymentUrl;
                $transaction->save();

                // DB::beginTransaction();
                // $response = Http::withBasicAuth(config('services.midtrans.serverKey'), '')
                //     ->post('https://api.sandbox.midtrans.com/v2/charge', [
                //         [
                //             'payment_type' => 'bank_transfer',
                //             'transaction_details' => [

                //                 'order_id' => $request->id_order,
                //                 'gross_amount' =>
                //                 (int) $order->total,
                //             ],
                //             'bank_transfer' => [
                //                 'bank'    => 'bca'

                //             ]
                //         ]
                //     ]);

                // DB::commit();
                // // dd($response);
                // if ($response) {
                //     return response()->json([
                //         'meta' => [
                //             'status' => 'failed Charged'
                //         ]
                //     ]);
                // } else {
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Success Checkout'
                    ],
                    'data' => $transaction
                ], 200);
                // }
            } catch (Exception $error) {
                // DB::rollBack();
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

    public function delete(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_order_detail' => 'required'
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

            $check_id_order_details = DB::table('order_details as od')
                ->select('od.id', 'od.quantity', 'o.id as id_order')
                ->where('os.name', 'cart')
                ->where('od.id', $request->id_order_detail)
                ->where('o.id_user', Auth::user()->id)
                ->join('orders as o', 'o.id', '=', 'od.id_order')
                ->join('order_status as os', 'os.id', '=', 'o.id_order_status')
                ->get();

            if (empty($check_id_order_details[0])) {
                return response()->json([
                    'meta' => [
                        'status' => 'Error',
                        'message' => 'Data Not Found'
                    ]
                ], 404);
            } else {
                $order_detail = Order_detail::findOrFail($check_id_order_details[0]->id);
                // dd($order_detail);
                $order_detail->delete();
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Success Delete'
                    ]
                ], 200);
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

    public function trigger_whatsapp()
    {
        try {
            $order = Orders::latest('updated_at')->first();
            // $order = Orders::where('id', 9)->get();
            if (empty($order)) {
                return response()->json([
                    'meta' => [
                        'status' => 'failed',
                        'message' => 'not found'
                    ]
                ], 200);
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => $order
                    ]
                ], 200);
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
