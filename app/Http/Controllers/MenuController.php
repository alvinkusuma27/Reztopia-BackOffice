<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $active = 'menu';
        $id = Auth::user()->id;
        // $categories = Categories::with('outlet')->get();
        $categories = DB::table('categories')
            ->select('categories.name', DB::raw('COUNT(p.id) as jumlah_produk'), 'p.name as nama_makanan', 'p.type_product', 'p.price')
            ->join('outlets as o', 'o.id', '=', 'categories.id_outlet')
            ->join('products as p', 'p.id_category', '=', 'categories.id')
            ->where('o.id_user', $id)
            ->groupBy('categories.name')
            ->get();
        $data = Categories::with('outlet')->get();
        // NAMA KATEGORI, JUMLAH PRODUK, GAMBAR PRODUK, NAMA PRODUK, TIPE PRODUK, HARGA PRODUK
        // dd($categories);
        return view('tenant.page.menu', compact('categories', 'active'));
    }
}
