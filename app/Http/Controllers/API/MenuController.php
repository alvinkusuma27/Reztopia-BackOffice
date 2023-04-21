<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index($tenant)
    {
        try {
            $product = DB::table('products as p')
                ->join('categories as c', 'c.id', '=', 'p.id_category')
                ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                ->where('o.id', $tenant)
                ->get();

            if (!empty($product[0])) {
                $result = array();
                foreach ($product as $item) {
                    $item->image = env('APP_URL')  . '/storage/uploads/product/' . $item->image;
                    array_push($result, $item);
                }

                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Successfully fetch data'
                    ],
                    'data' => $result
                ], 200);
            }

            return response()->json([
                'meta' => [
                    'status' => 'failed',
                    'message' => 'Data not found'
                ]
            ], 404);
        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
    }

    // public function filterNsort($tenant, $filter = null, $sort = null)
    // {
    //     // dd($filter, $sort);
    //     try {
    //         if (!empty($filter) && !empty($sort)) {
    //             $product = DB::table('products as p')
    //                 ->select('p.original_price', 'p.image', 'p.name')
    //                 ->join('categories as c', 'c.id', '=', 'p.id_category')
    //                 ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
    //                 ->where('o.id', $tenant)
    //                 ->where('c.id', $filter)
    //                 ->orderBy('p.original_price', $sort)
    //                 ->get();
    //             return response()->json([
    //                 'meta' => [
    //                     'status' => 'success',
    //                     'message' => 'Successfully fetch data'
    //                 ],
    //                 'data' => $product
    //             ], 200);
    //         }
    //     } catch (Exception $error) {
    //         // dd($error);
    //         return response()->json([
    //             'meta' => [
    //                 'status' => 'error',
    //                 'message' => 'something went wrong'
    //             ],
    //             'data' => $error->getMessage()
    //         ], 500);
    //     }
    // }



    // SEMUA FILTER DIJADIKAN POST
    // DICARI FILTER BERDASARKAN REQUEST



    public function filterNSort(Request $request)
    {
        // diganti method post
        // SEK GRUNG MARI
        try {

            if ($request->filter) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'filter' => 'required'
                    ]
                );
                if (!$validator->fails()) {
                    $data = $request->all();
                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Successfully fetch data'
                        ],
                        'data' => $data
                    ], 200);
                }
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Successfully fetch data'
                    ],
                    'data' => $validator->messages()->all()
                ], 200);
            } else if ($request->sort) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'sort' => 'in:asc,desc'
                    ]
                );
                if (!$validator->fails()) {
                    $data = $request->all();
                    return response()->json([
                        'meta' => [
                            'status' => 'success',
                            'message' => 'Successfully fetch data'
                        ],
                        'data' => $data
                    ], 200);
                }
            }
            // $data = [
            //     'yaya' => 1
            // ];
            // return response()->json([
            //     'meta' => [
            //         'status' => 'success',
            //         'message' => 'Successfully fetch data'
            //     ],
            //     'data' => $data
            // ], 200);
            // if ($value == 'asc' || $value == 'desc') {

            //     $product = DB::table('products as p')
            //         ->select('p.original_price', 'p.image', 'p.name')
            //         ->join('categories as c', 'c.id', '=', 'p.id_category')
            //         ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
            //         ->where('o.id', $tenant)
            //         ->orderBy('p.original_price', $value)
            //         ->get();
            // } else {
            //     $data = [1, 2];
            //     // $queryString = http_build_query(['value' => json_encode($data)]);
            //     // dd($queryString);
            //     $data = json_decode(request()->query('data'), true);
            //     dd($data);
            //     $product = array();
            //     $product_1 = DB::table('products as p')
            //         ->select('p.original_price', 'p.image', 'p.name')
            //         ->join('categories as c', 'c.id', '=', 'p.id_category')
            //         ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
            //         ->where('o.id', $tenant)
            //         ->where('c.id', $value)
            //         ->get();

            //     // array_push($product, $product_1)
            //     // dd($product);
            // }

            // return response()->json([
            //     'meta' => [
            //         'status' => 'success',
            //         'message' => 'Successfully fetch data'
            //     ],
            //     'data' => $product
            // ], 200);
        } catch (Exception $error) {

            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
        // dd($tenant, $value);
    }

    public function viewProduct($tenant, $id)
    {
        try {
            $product = DB::table('products as p')
                ->select('p.original_price', 'p.image', 'p.name', 'p.description')
                ->join('categories as c', 'c.id', '=', 'p.id_category')
                ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                ->where('o.id', $tenant)
                ->where('p.id', $id)
                ->get();

            if (empty($product[0])) {
                return response()->json([
                    'meta' => [
                        'status' => 'Failed',
                        'message' => 'Data not found'
                    ]
                ], 404);
            }
            return response()->json([
                'meta' => [
                    'status' => 'susccess',
                    'message' => 'Successfully fetch data'
                ], 'data' => [
                    'data' => $product
                ]
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
    }
}
