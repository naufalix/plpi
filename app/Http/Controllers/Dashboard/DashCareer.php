<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Meta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashCareer extends Controller
{

    public function previlege($p){
        $auth = Auth::guard('user')->user();
        $previlege = explode(",",$auth->previlege);
        if(!in_array($p, $previlege)){ return false; }
        return true;
    }
    
    public function index(){
        if(!$this->previlege('A')){
            return redirect('/dashboard/home')->with("info","Anda tidak punya akses");
        }
        $meta = Meta::$data_meta;
        $meta['title'] = 'Dashboard | Data karir';
        return view('dashboard.career',[
            "meta" => $meta,
            "careers" => Career::with(['user'])->get(),
            "users" => User::all(),
            "profil" => Auth::guard('user')->user(),
        ]);
    }

    public function postHandler(Request $request){
        $this->previlege(6);
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dashboard/career')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dashboard/career')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/dashboard/career')->with($res['status'],$res['message']);
        }else{
            return redirect('/dashboard/career')->with("info","Submit not found");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'user_id'=>'required|numeric',
            'position' => 'required',
            'rank' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);

        // Create Career
        Career::create($validatedData);
        return ['status'=>'success','message'=>'Karir berhasil ditambahkan']; 
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'position' => 'required',
            'rank' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);
        
        //Check if career is found
        if(Career::find($request->id)){
            //Check user
            if(!User::find($request->user_id)){
                return ['status'=>'error','message'=>'User tidak ditemukan'];
            }
            // Update career
            Career::find($request->id)->update($validatedData);   
            return ['status'=>'success','message'=>'Karir berhasil diedit']; 
        }else{
            return ['status'=>'error','message'=>'Karir tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        //Check if the career is found
        if(Career::find($request->id)){
            Career::destroy($request->id);    // Delete career
            return ['status'=>'success','message'=>'Karir berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Karir tidak ditemukan'];
        }
    }
}
