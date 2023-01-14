<?php

namespace App\Http\Controllers;
use App\Models\Meta;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{

    public function index(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'PLPI | Katalog';
        return view('shop',[
            "meta" => $meta,
            "products" => Product::all(),
        ]);
    }

}
