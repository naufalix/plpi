<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashUser extends Controller
{

    public function previlege($p){
        $auth = Auth::guard('user')->user();
        $previlege = explode(",",$auth->previlege);
        if(!in_array($p, $previlege)){ return false; }
        return true;
    }
    
    public function index(){
        if(!$this->previlege(6)){
            return redirect('/dashboard/home')->with("info","Anda tidak punya akses");
        }
        $meta = Meta::$data_meta;
        $meta['title'] = 'Dashboard | Pengaturan User';
        return view('dashboard.user',[
            "meta" => $meta,
            "users" => User::all(),
        ]);
    }

    public function postHandler(Request $request){
        $this->previlege(6);
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
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'birthday' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'previlege'=>'required',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['previlege'] = implode(",",$validatedData['previlege']);
        //dd($validatedData);

        // Check Email
        if(!User::whereEmail($request->email)->first()){
            // Create new user
            User::create($validatedData);
            return ['status'=>'success','message'=>'User berhasil ditambahkan'];
        }else{
            return ['status'=>'error','message'=>'Email telah terpakai'];
        }
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'birthday' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'previlege'=>'required',
        ]);
        $validatedData['previlege'] = implode(",",$validatedData['previlege']);

        $user = User::find($request->id);
        $oldEmail = $user->email;
        $newEmail = $request->email;
        
        //Check if password empty
        if(!$request->password){
            $validatedData['password'] = $user->password;
        }else{
            $validatedData['password'] = Hash::make($request->password);
        }
        
        //Check if the user is found
        if($user){
            //Check email
            if($newEmail!=$oldEmail){
                if(User::whereEmail($request->email)->first()){
                    return ['status'=>'error','message'=>'Email telah terpakai'];
                }
            }
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
            // Delete career
            $user->career()->delete();
            // Delete certification
            $user->certification()->delete();
            // Delete cooperation
            $user->cooperation()->delete();
            // Delete photo
            if($user->photo){
                $logo_path = public_path().'/assets/img/user/'.$user->photo;
                unlink($logo_path);         // Delete photo
            }
            User::destroy($request->id);    // Delete user
            return ['status'=>'success','message'=>'User berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'User tidak ditemukan'];
        }
    }
}
