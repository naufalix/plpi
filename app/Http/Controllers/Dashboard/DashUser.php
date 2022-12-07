<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DashUser extends Controller
{

    public function role(){
        $auth = Auth::guard('user')->user();
        if($auth->role!='superadmin'){
            return Redirect::back()->with("info","Anda tidak punya akses");
        }
    }

    public function index(){
        $this->role();
        $meta = Meta::$data_meta;
        $meta['title'] = 'Dashboard | User';
        return view('dashboard.user',[
            "meta" => $meta,
            "provinces" => Province::all(),
            "users" => User::with(['province'])->get(),
        ]);
    }

    public function postHandler(Request $request){
        $this->role();
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dashboard/user')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dashboard/user')->with($res['status'],$res['message']);
        }
        if($request->submit=="photo"){
            $res = $this->photo($request);
            return redirect('/dashboard/user')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/dashboard/user')->with($res['status'],$res['message']);
            // return redirect('/dashboard/user')->with("info","Fitur hapus sementara dinonaktifkan");
        }else{
            return redirect('/dashboard/user')->with("info","Submit not found");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'=>'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role'=>'required',
            'province_id'=>'required|numeric',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Check Username
        if(!User::whereUsername($request->username)->first()){
            // Check Email
            if(!User::whereEmail($request->email)->first()){
                // Create new user
                User::create($validatedData);
                return ['status'=>'success','message'=>'User berhasil ditambahkan'];
            }else{
                return ['status'=>'error','message'=>'Email telah terpakai'];
            }
        }else{
            return ['status'=>'error','message'=>'Username telah terpakai'];
        }
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'username' => 'required',
            'email' => 'required',
            'role'=>'required',
            'province_id'=>'required|numeric',
        ]);

        $user = User::find($request->id);

        //Check if password empty
        if(!$request->password){
            $validatedData['password'] = $user->password;
        }else{
            $validatedData['password'] = Hash::make($request->password);
        }

        //Check if the user is found
        if($user){
            // Update user
            $user->update($validatedData);   
            return ['status'=>'success','message'=>'User berhasil diedit']; 
        }else{
            return ['status'=>'error','message'=>'User tidak ditemukan'];
        }
    }

    public function photo(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'photo' => 'image|file|max:1024',
        ]);

        $user = User::find($request->id);

        if($request->file('photo')){
            //$validatedData['logo'] = $request->file('logo')->getClientOriginalName();
            //$filename = pathinfo(Input::file('logo')->getClientOriginalName(), PATHINFO_FILENAME);
            $validatedData['photo'] = $request->id.".png";
            $request->file('photo')->move(public_path('assets/img/user'), $validatedData['photo']);
            //$request->file('logo')->storeAs('assets/img/univ',$validatedData['logo'],'public');
            $user->update($validatedData);
            return ['status'=>'success','message'=>'Foto berhasil diedit']; 
        }else{
            return ['status'=>'error','message'=>'Foto gagal diedit'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $user = User::find($request->id);

        //Check if the user is found
        if($user){
            $logo_path = public_path().'/assets/img/user/'.$request->id.'.png';
            unlink($logo_path);             // Delete photo
            User::destroy($request->id);    // Delete user
            return ['status'=>'success','message'=>'User berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'User tidak ditemukan'];
        }
    }
}
