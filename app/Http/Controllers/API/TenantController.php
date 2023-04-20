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
                $item->link = env('APP_URL') . route('tenant.menu', $item->id);
                array_push($results_tenant, $item);
            }
            // dd($results_tenant);
            $results_categories = array();
            foreach ($categories as $item) {
                $item->image = env('APP_URL') . '/storage/uploads/categories/' . $item->image;
                $item->link = route('tenant.menu', $item->id);
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

        // search tenant, link tenant
        // $customer = DB::table('customer')
        //     ->where('customer.name', 'LIKE', "%$findcustomer%")
        //     ->orWhere('customer.phone', 'LIKE', "%$findcustomer%")
        //     ->get();

        // return View::make("your view here");

        try {

            // $validator = Validator::make($request->all(), [
            //     'search' => 'string|required'
            // ]);

            // if (!$validator->fails()) {
            $search = DB::table('products as p')
                ->select('p.name as nama_produk', 'o.name as tenant_name', 'c.name as category_name')
                ->join('categories as c', 'c.id', '=', 'p.id_category')
                ->join('outlets as o', 'o.id', '=', 'c.id_outlet')
                ->where('o.name', $value)
                ->orWhere('c.name', $value)
                ->orWhere('p.name', $value)
                ->get();

            // $data = $request->all();
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
            // }

            // return response()->json([
            //     'meta' => [
            //         'status' => 'error',
            //         'message' => 'bad request'
            //     ],
            //     'data' => $validator->messages()->all()
            // ], 400);
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
