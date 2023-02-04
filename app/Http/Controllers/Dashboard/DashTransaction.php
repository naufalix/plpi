<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Meta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashTransaction extends Controller
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
        $meta['title'] = 'Dashboard | Data Transaksi';
        return view('dashboard.transaction',[
            "meta" => $meta,
            "transactions" => Transaction::with(['user'])->get(),
            "users" => User::all(),
            "profil" => Auth::guard('user')->user(),
        ]);
    }

    public function postHandler(Request $request){
        $this->previlege(6);
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dashboard/transaction')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dashboard/transaction')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/dashboard/transaction')->with($res['status'],$res['message']);
        }else{
            return redirect('/dashboard/transaction')->with("info","Submit not found");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'user_id'=>'required|numeric',
            'reception' => 'required|numeric',
            'loan' => 'required|numeric',
            'date'=>'required',
        ]);

        // Create transaction
        Transaction::create($validatedData);
        return ['status'=>'success','message'=>'Transaksi berhasil ditambahkan']; 
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'reception' => 'required|numeric',
            'loan' => 'required|numeric',
            'date'=>'required',
        ]);
        
        //Check if transaction is found
        if(Transaction::find($request->id)){
            //Check user
            if(!User::find($request->user_id)){
                return ['status'=>'error','message'=>'User tidak ditemukan'];
            }
            // Update transaction
            Transaction::find($request->id)->update($validatedData);   
            return ['status'=>'success','message'=>'Transaksi berhasil diedit']; 
        }else{
            return ['status'=>'error','message'=>'Transaksi tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        //Check if the transaction is found
        if(Transaction::find($request->id)){
            Transaction::destroy($request->id);    // Delete transaction
            return ['status'=>'success','message'=>'Transaksi berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Transaksi tidak ditemukan'];
        }
    }
}
