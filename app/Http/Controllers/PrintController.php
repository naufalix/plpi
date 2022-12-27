<?php

namespace App\Http\Controllers;
use App\Models\Meta;
use App\Models\Career;
use App\Models\Certification;
use App\Models\Cooperation;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PrintController extends Controller
{

    
    public function user(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Laporan User';
        return view('print.user',[
            "meta" => $meta,
            "users" => User::all(),
        ]);
    }

    public function career(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Laporan Karir';
        return view('print.career',[
            "meta" => $meta,
            "careers" => Career::with(['user'])->get()
        ]);
    }

    public function certification(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Laporan Sertifikasi';
        return view('print.certification',[
            "meta" => $meta,
            "certifications" => Certification::with(['user'])->get()
        ]);
    }

    public function cooperation(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Laporan Kerjasama';
        return view('print.cooperation',[
            "meta" => $meta,
            "cooperations" => Cooperation::with(['user'])->get()
        ]);
    }

    public function transaction(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Laporan Transaksi';
        return view('print.transaction',[
            "meta" => $meta,
            "transactions" => Transaction::with(['user'])->get()
        ]);
    }
}
