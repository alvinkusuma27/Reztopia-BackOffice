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
                ->select(
                    'p.original_price as original_price',
                    'p.price_final as price_after_discount',
                    'p.discount as discount',
                    'p.image as image_product',
                    'p.name as name_product',
                    'p.description as description_product',
                    'o.id as id_outlet',
                    'p.id as id_product',
                    'c.id as id_category',
                    'c.name as name_category'
                )
                ->join('categories as c', 'c.id', '=', 'p.id_category')
                ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                ->where('o.id', $tenant)
                ->get();
            // dd($product);
            if (!empty($product[0])) {
                // dd($product);
                $result = array();
                foreach ($product as $item) {
                    unset($item->id);
                    $item->image_product = env('APP_URL')  . '/storage/uploads/products/' . $item->image_product;
                    array_push($result, $item);
                }
                // dd($product, $result);
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

    public function filterNSort(Request $request)
    {
        try {
            $result = array();
            if ($request->filter && $request->sort) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'id_outlet' => 'required|integer',
                        'filter' => 'required|integer',
                        'sort' => 'required|in:asc,desc'
                    ]
                );
                if (!$validator->fails()) {
                    $filter = array();
                    $for_filter_array = $request->all();
                    unset($for_filter_array['id_outlet']);
                    unset($for_filter_array['sort']);
                    foreach ($for_filter_array as $item) {
                        array_push($filter, $item);
                    }
                    // dd($for_filter_array);
                    $data = DB::table('products as p')
                        ->select(
                            'p.original_price as original_price',
                            'p.price_final as price_after_discount',
                            'p.discount as discount',
                            'p.image as image_product',
                            'p.name as name_product',
                            'p.description as description_product',
                            'o.id as id_outlet',
                            'p.id as id_product',
                            'c.name as name_category'
                        )
                        ->join('categories as c', 'c.id', '=', 'p.id_category')
                        ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                        ->where('o.id', $request->id_outlet)
                        ->whereIn('c.id', $filter)
                        ->orderBy('p.original_price', $request->sort)
                        ->get();

                    // $data = $request->all();
                    // $data = $request->all();
                    // dd($data, $filter);
                    if (!empty($data[0])) {
                        foreach ($data as $item) {
                            // unset($item->id);
                            // dd($item);
                            $item->image_product = env('APP_URL')  . '/storage/uploads/product/' . $item->image_product;
                            array_push($result, $item);
                        }
                        return response()->json([
                            'meta' => [
                                'status' => 'success',
                                'message' => 'Successfully fetch data'
                            ],
                            'data' => $result
                        ], 200);
                    } else {

                        return response()->json([
                            'meta' => [
                                'status' => 'failed',
                                'message' => 'Data Not Found'
                            ]
                        ], 404);
                    }
                }
                return response()->json([
                    'meta' => [
                        'status' => 'Failed',
                        'message' => 'Bad Requst'
                    ],
                    'data' => $validator->messages()->all()
                ], 400);
            } else if ($request->sort && empty($request->filter)) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'id_outlet' => 'required|integer',
                        'sort' => 'in:asc,desc'
                    ]
                );
                if (!$validator->fails()) {
                    $data = DB::table('products as p')
                        ->select(
                            'p.original_price as original_price',
                            'p.price_final as price_after_discount',
                            'p.discount as discount',
                            'p.image as image_product',
                            'p.name as name_product',
                            'p.description as description_product',
                            'o.id as id_outlet',
                            'p.id as id_product',
                            'c.name as name_category'
                        )
                        ->join('categories as c', 'c.id', '=', 'p.id_category')
                        ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                        ->where('o.id', $request->id_outlet)
                        ->orderBy('p.original_price', $request->sort)
                        ->get();
                    // $request->sort;
                    // dd($data);
                    if (!empty($data[0])) {
                        foreach ($data as $item) {
                            // unset($item->id);
                            // dd($item);
                            $item->image_product = env('APP_URL')  . '/storage/uploads/product/' . $item->image_product;
                            array_push($result, $item);
                        }
                        return response()->json([
                            'meta' => [
                                'status' => 'success',
                                'message' => 'Successfully fetch data'
                            ],
                            'data' => $result
                        ], 200);
                    } else {
                        return response()->json([
                            'meta' => [
                                'status' => 'failed',
                                'message' => 'Data Not Found'
                            ]
                        ], 400);
                    }
                }
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Successfully fetch data'
                    ],
                    'data' => $validator->messages()->all()
                ], 200);
            } else if ($request->filter && empty($request->sort)) {
                $validator = Validator::make($request->all(), [
                    'id_outlet' => 'required|integer',
                    'filter' => 'required|integer'
                ]);


                if (!$validator->fails()) {
                    $filter = array();
                    $for_filter_array = $request->all();
                    unset($for_filter_array['id_outlet']);
                    foreach ($for_filter_array as $item) {
                        array_push($filter, $item);
                    }
                    $data = DB::table('products as p')
                        ->select(
                            'p.original_price as original_price',
                            'p.price_final as price_after_discount',
                            'p.discount as discount',
                            'p.image as image_product',
                            'p.name as name_product',
                            'p.description as description_product',
                            'o.id as id_outlet',
                            'p.id as id_product',
                            'c.name as name_category'
                        )
                        ->join('categories as c', 'c.id', '=', 'p.id_category')
                        ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                        ->where('o.id', $request->id_outlet)
                        ->whereIn('c.id', $filter)
                        ->get();
                    if (!empty($data[0])) {
                        foreach ($data as $item) {
                            // unset($item->id);
                            // dd($item);
                            $item->image_product = env('APP_URL')  . '/storage/uploads/product/' . $item->image_product;
                            array_push($result, $item);
                        }
                        return response()->json([
                            'meta' => [
                                'status' => 'success',
                                'message' => 'Successfully fetch data'
                            ],
                            'data' => $result
                        ], 200);
                    } else {
                        return response()->json([
                            'meta' => [
                                'status' => 'failed',
                                'message' => 'Data Not Found'
                            ]
                        ], 400);
                    }
                }
                return response()->json([
                    'meta' => [
                        'status' => 'Failed',
                        'message' => 'Bad Requst'
                    ],
                    'data' => $validator->messages()->all()
                ], 400);
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'failed',
                        'message' => 'Parameter sort and filter not found'
                    ]
                ], 400);
            }
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

    // public function viewFilterNSort(){

    // }

    public function viewProduct($tenant, $id)
    {
        try {
            $product = DB::table('products as p')
                // ->select('p.original_price', 'p.image', 'p.name', 'p.description')
                ->select(
                    'p.original_price as original_price',
                    'p.price_final as price_after_discount',
                    'p.discount as discount',
                    'p.image as image_product',
                    'p.name as name_product',
                    'p.description as description_product',
                    'o.id as id_outlet',
                    'p.id as id_product'
                )
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
            $result = array();
            foreach ($product as $item) {
                $item->image_product = env('APP_URL') . '/storage/uploads/history-detail/' . $item->image_product;
                array_push($result, $item);
            }
            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'message' => 'Successfully fetch data'
                ], 'data' => [
                    'data' => $result,
                    'link' => route('addCart')
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
