<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Cooperation;
use App\Models\Meta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashCooperation extends Controller
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
        $meta['title'] = 'Dashboard | Data kerjasama';
        return view('dashboard.cooperation',[
            "meta" => $meta,
            "cooperations" => Cooperation::with(['user'])->get(),
            "users" => User::all(),
        ]);
    }

    public function postHandler(Request $request){
        $this->previlege(6);
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dashboard/cooperation')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dashboard/cooperation')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/dashboard/cooperation')->with($res['status'],$res['message']);
        }else{
            return redirect('/dashboard/cooperation')->with("info","Submit not found");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'user_id'=>'required|numeric',
            'name' => 'required',
            'start_date' => 'required',
            'end_date'=>'required',
        ]);

        // Create cooperation
        Cooperation::create($validatedData);
        return ['status'=>'success','message'=>'Kerjasama berhasil ditambahkan']; 
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'name' => 'required',
            'start_date' => 'required',
            'end_date'=>'required',
        ]);
        
        //Check if cooperation is found
        if(Cooperation::find($request->id)){
            //Check user
            if(!User::find($request->user_id)){
                return ['status'=>'error','message'=>'User tidak ditemukan'];
            }
            // Update cooperation
            Cooperation::find($request->id)->update($validatedData);   
            return ['status'=>'success','message'=>'Kerjasama berhasil diedit']; 
        }else{
            return ['status'=>'error','message'=>'Kerjasama tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        //Check if the cooperation is found
        if(Cooperation::find($request->id)){
            Cooperation::destroy($request->id);    // Delete cooperation
            return ['status'=>'success','message'=>'Kerjasama berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Kerjasama tidak ditemukan'];
        }
    }
}
