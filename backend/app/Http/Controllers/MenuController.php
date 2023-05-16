<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Categories;
use App\Models\Orders;
use App\Models\Outlet;
use App\Models\Products;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    public function index()
    {
        // try {
        $active = 'menu';
        $id = Auth::user()->id;
        $outlet_name = Outlet::where('id_user', $id)->select('name')->get();
        $products = DB::table('categories')
            ->select(
                'categories.id as id_category',
                'categories.image',
                'categories.name',
                DB::raw('COUNT(p.id) as jumlah_produk'),
                'p.name as nama_makanan',
                'p.description',
                'p.original_price',
                'p.cost_price',
                'p.discount',
                'p.price_final',
                'o.id',
                'p.image as image_product',
                'o.name as outlet_name',
                'p.id as id_product'
            )
            ->join('outlets as o', 'o.id', '=', 'categories.id_outlet')
            ->join('products as p', 'p.id_category', '=', 'categories.id')
            ->where('o.id_user', $id)
            ->groupBy('p.id')
            ->get();
        // dd($products);

        $for_categories =
            DB::table('categories')
            ->select(
                'categories.name',
                DB::raw('COUNT(p.id) as jumlah_produk'),
            )
            ->join('outlets as o', 'o.id', '=', 'categories.id_outlet')
            ->join('products as p', 'categories.id', '=', 'p.id_category')
            ->where('o.id_user', $id)
            ->groupBy('categories.name')
            ->get();

        $id_outlet_by_user = Outlet::where('id_user', $id)
            ->select('id')
            ->get();
        $id_outlet = $id_outlet_by_user[0]->id;
        $categories = Categories::where('id_outlet', $id_outlet)
            // ->select('name', 'id')
            ->get();
        // dd($categories);
        // dd($id_outlet);

        // NAMA KATEGORI, JUMLAH PRODUK, GAMBAR PRODUK, NAMA PRODUK, TIPE PRODUK, HARGA PRODUK
        // dd($categories);
        return view('tenant.page.menu', compact('categories', 'products', 'active', 'id_outlet', 'for_categories', 'outlet_name'));
        // } catch (Exception $error) {
        //     dd($error->getMessage());
        // }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_outlet' => 'required',
                'name' => 'required',
                'description' => 'required',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if (!$validator->fails()) {
                // $image = $request->file('image');
                // $image_name = time() . '-categories-' . $request->name . '.' . $image->getClientOriginalExtension();
                // Storage::putFileAs('public/uploads/categories/', $image, $image_name);
                $categories = new Categories();
                $categories->name = $request->name;
                $categories->description = $request->description;
                // $categories->image = $image_name;
                $categories->created_at = Carbon::now();
                $categories->id_outlet = $request->id_outlet;
                $categories->save();
                Alert::toast('Category Created Successfully', 'success');
                return back();
            }
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function store_product(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'original_price' => 'required|numeric',
                'cost_price' => 'required|numeric',
                'id_category' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if (!$validator->fails()) {
                $products = new Products();
                $products->name = $request->name;
                $products->description = $request->description;
                $products->original_price = $request->original_price;
                $products->cost_price = $request->cost_price;
                $products->id_category = $request->id_category;
                $products->discount = $request->discount;
                $products->price_final = $request->original_price - $request->discount;
                $image = $request->file('image');
                $image_name = time() . '-products-' . $request->name . '.' . $image->getClientOriginalExtension();
                Storage::putFileAs('public/uploads/products/', $image, $image_name);
                $products->image = $image_name;
                $products->active = 1;
                $products->created_by = Auth::user()->id;
                $products->save();
                Alert::toast('Add Product Successfully', 'success');
                return back();
            }
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        try {
            $categories = Categories::findOrFail($id);
            if (!$request->hasFile('image')) {
                $categories->update([
                    'name' => $request->name,
                    'description' => $request->description
                ]);
                if ($request->has('id_product')) {
                    foreach ($request->id_product as $item) {
                        $products = Products::findOrFail($item);
                        $products->update([
                            'id_category' => $request->id_category
                        ]);
                    }
                }
                Alert::toast('Success Update Categories', 'success');
                return redirect()->route('menu');
            }
            // $validator = Validator::make($request->all(), [
            //     'image' => 'requuired|image|mimes:jpeg,png,jpg,gif|max:2048',
            // ]);
            // if (!$validator->fails()) {
            //     $image = $request->file('image');
            //     $image_name = time() . '-categories-update-' . $request->name . '.' . $image->getClientOriginalExtension();
            //     Storage::putFileAs('public/uploads/categories/', $image, $image_name);
            //     $categories->update([
            //         'name' => $request->name,
            //         'description' => $request->description,
            //         'image' => $image_name
            //     ]);
            //     Alert::toast('Success Update Categories', 'success');
            //     return redirect()->route('menu');
            // }
            // Alert::toast($validator->messages()->all(), 'error');
            // return back();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }


    public function update_product(Request $request)
    {
        try {
            if (!$request->hasFile('image')) {
                // dd($request->all());
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'description' => 'required',
                    'original_price' => 'required|numeric',
                    'cost_price' => 'required|numeric',
                    'id_category' => 'required'
                ]);
                if (!$validator->fails()) {
                    $products = Products::findOrFail($request->id_product);
                    // dd($request->original_price, $request->discount, $request->original_price - $request->discount);
                    $products->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'original_price' => $request->original_price,
                        'cost_price' => $request->cost_price,
                        'id_category' => $request->id_category,
                        'discount' => $request->discount,
                        'price_final' => $request->original_price - $request->discount,
                    ]);
                    Alert::toast('Success Update Product', 'success');
                    return back();
                }
                Alert::toast($validator->messages()->all(), 'error');
                return back()->withInput();
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'description' => 'required',
                    'original_price' => 'required|numeric',
                    'cost_price' => 'required|numeric',
                    'id_category' => 'required',
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                if (!$validator->fails()) {
                    $image = $request->file('image');
                    $image_name = time() . '-products-update-' . $request->name . '.' . $image->getClientOriginalExtension();
                    Storage::putFileAs('public/uploads/products/', $image, $image_name);
                    $products = Products::findOrFail($request->id_product);
                    $products->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'original_price' => $request->original_price,
                        'cost_price' => $request->cost_price,
                        'id_category' => $request->id_category,
                        'discount' => $request->discount,
                        'price_final' => $request->original_price - $request->discount,
                        'image' => $image_name
                    ]);
                    Alert::toast('Success Update Product', 'success');
                    return back();
                }
                Alert::toast($validator->messages()->all(), 'error');
                return back()->withInput();
            }
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            // dd($request->all());
            $products = Products::whereIn('id_category', $request->all())->select('id')->get();
            // $id = (int) $products[0]->id;
            if (!empty($products[0])) {
                // dd($products);
                Cart::where('id_product', $products[0]->id)->delete();
            }
            Orders::whereIn('id_category', $request->all())->delete();
            Products::whereIn('id_category', $request->all())->delete();
            Categories::whereIn('id', $request->all())->delete();

            Alert::toast('Success Delete Categories', 'success');
            return redirect()->route('menu');


            // dd($products[0]);
        } catch (Exception $error) {
            dd($error->getMessage());
        }
        // cart, orders, products['products on other table' => cart,]
    }

    public function destroy_product(Request $request)
    {
        try {
            $cart = Cart::whereIn('id_product', $request->all())->delete();
            $products = Products::WhereIn('id', $request->all())->delete();
            // dd($cart, $products);
            Alert::toast('Success Delete Product', 'success');
            return back();
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }
}
