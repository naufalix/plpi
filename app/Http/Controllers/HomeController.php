<?php

namespace App\Http\Controllers;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    
    public function index(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'PLPI | Homepage';
        return view('home',[
            "meta" => $meta,
        ]);
    }

}
