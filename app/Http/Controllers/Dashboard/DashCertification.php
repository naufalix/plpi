<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Meta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashCertification extends Controller
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
        $meta['title'] = 'Dashboard | Data sertifikasi';
        return view('dashboard.certification',[
            "meta" => $meta,
            "certifications" => Certification::with(['user'])->get(),
            "users" => User::all(),
            "profil" => Auth::guard('user')->user(),
        ]);
    }

    public function postHandler(Request $request){
        $this->previlege(6);
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dashboard/certification')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dashboard/certification')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/dashboard/certification')->with($res['status'],$res['message']);
        }else{
            return redirect('/dashboard/certification')->with("info","Submit not found");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'user_id'=>'required|numeric',
            'name' => 'required',
            'location' => 'required',
            'issue_date'=>'required',
        ]);

        // Create certification
        Certification::create($validatedData);
        return ['status'=>'success','message'=>'Sertifikasi berhasil ditambahkan']; 
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'name' => 'required',
            'location' => 'required',
            'issue_date'=>'required',
        ]);
        
        //Check if certification is found
        if(Certification::find($request->id)){
            //Check user
            if(!User::find($request->user_id)){
                return ['status'=>'error','message'=>'User tidak ditemukan'];
            }
            // Update certification
            Certification::find($request->id)->update($validatedData);   
            return ['status'=>'success','message'=>'Sertifikasi berhasil diedit']; 
        }else{
            return ['status'=>'error','message'=>'Sertifikasi tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        //Check if the certification is found
        if(Certification::find($request->id)){
            Certification::destroy($request->id);    // Delete certification
            return ['status'=>'success','message'=>'Sertifikasi berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Sertifikasi tidak ditemukan'];
        }
    }
}
