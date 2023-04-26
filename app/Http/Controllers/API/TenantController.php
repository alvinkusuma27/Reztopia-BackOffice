<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Outlet;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    public function index()
    {

        // link tenant, information tenant
        try {
            $tenant = Outlet::all();
            $categories = Categories::all();
            $results_tenant = array();
            foreach ($tenant as $item) {
                $item->image = env('APP_URL') . '/storage/uploads/tenant/' . $item->image;
                $item->link = env('APP_URL') . route('tenant.search', $item->id);
                array_push($results_tenant, $item);
            }
            // dd($results_tenant);
            $results_categories = array();
            foreach ($categories as $item) {
                $item->image = env('APP_URL') . '/storage/uploads/categories/' . $item->image;
                $item->link = route('menu.index', $item->id);
                array_push($results_categories, $item);
            }
            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'message' => 'Successfully fetch data'
                ],
                'data' => [
                    'tenant' => $results_tenant,
                    'categories' => $results_categories
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

    public function search($value)
    {

        try {
            if (!empty($value)) {
                $search = DB::table('products as p')
                    ->select('p.name as nama_produk', 'o.name as tenant_name', 'c.name as category_name')
                    ->join('categories as c', 'c.id', '=', 'p.id_category')
                    ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                    ->where('o.name', 'LIKE', '%' . $value . '%')
                    ->orWhere('c.name', 'LIKE', '%' . $value . '%')
                    ->orWhere('p.name', 'LIKE', '%' . $value . '%')
                    ->get();

                if (empty($search[0])) {
                    return response()->json([
                        'meta' => [
                            'status' => 'failed',
                            'message' => 'Data Not Found'
                        ]
                    ], 400);
                }
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'message' => 'Data Successfully Fetch',
                    ],
                    'data' => $search
                ], 200);
            } else {
                return response()->json([
                    'meta' => [
                        'status' => 'failed',
                        'message' => 'Bad Request'
                    ],
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
    }
}
