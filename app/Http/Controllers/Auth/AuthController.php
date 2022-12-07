<?php

namespace App\Http\Controllers\Auth;
use App\Models\Meta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private function meta(){
        $meta = Meta::$data_meta;
        $meta['title'] = 'Login';
        return $meta;
    }

    public function index(){
        return view('dashboard.login',[
            "meta" => $this->meta(),
        ]);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::guard('user')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/home');
        }

        // return view('admin.login',[
        //     "meta" => $this->meta(),
        // ]);

        return back()->with('error','Login failed!');
    }

    public function logout(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }
        return redirect('/dashboard/login');
    }
}
