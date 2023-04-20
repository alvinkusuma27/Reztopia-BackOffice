<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
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

    public function filterNsort($tenant, $filter = null, $sort = null)
    {
        // dd($filter, $sort);
        try {
            if (!empty($filter) && !empty($sort)) {
                $product = DB::table('products as p')
                    ->select('p.original_price', 'p.image', 'p.name')
                    ->join('categories as c', 'c.id', '=', 'p.id_category')
                    ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                    ->where('o.id', $tenant)
                    ->where('c.id', $filter)
                    ->orderBy('p.original_price', $sort)
                    ->get();
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Successfully fetch data'
                    ],
                    'data' => $product
                ], 200);
            }
        } catch (Exception $error) {
            // dd($error);
            return response()->json([
                'meta' => [
                    'status' => 'error',
                    'message' => 'something went wrong'
                ],
                'data' => $error->getMessage()
            ], 500);
        }
    }

    public function filterOrSort($tenant, $value)
    {
        // dd($value);
        try {
            if ($value == 'asc' || $value == 'desc') {

                $product = DB::table('products as p')
                    ->select('p.original_price', 'p.image', 'p.name')
                    ->join('categories as c', 'c.id', '=', 'p.id_category')
                    ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                    ->where('o.id', $tenant)
                    ->orderBy('p.original_price', $value)
                    ->get();
            } else {

                $product = DB::table('products as p')
                    ->select('p.original_price', 'p.image', 'p.name')
                    ->join('categories as c', 'c.id', '=', 'p.id_category')
                    ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                    ->where('o.id', $tenant)
                    ->where('c.id', $value)
                    ->get();
                dd($product);
            }

            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'message' => 'Successfully fetch data'
                ],
                'data' => $product
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
        // dd($tenant, $value);
    }
}
