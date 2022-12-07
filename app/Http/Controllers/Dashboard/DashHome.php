<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

class DashHome extends Controller
{
    private function meta(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Dashboard | Home';
        return $meta;
    }

    public function index(){
        return view('dashboard.home',[
            "meta" => $this->meta(),
        ]);
    }
}
