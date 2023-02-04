<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Meta;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashProduct extends Controller
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
        $meta['title'] = 'Dashboard | Data Produk';
        return view('dashboard.product',[
            "meta" => $meta,
            "categories" => Category::all(),
            "products" => Product::with(['category'])->get(),
            "profil" => Auth::guard('user')->user(),
        ]);
    }

    public function postHandler(Request $request){
        $this->previlege(6);
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/dashboard/product')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/dashboard/product')->with($res['status'],$res['message']);
        }
        if($request->submit=="photo"){
            $res = $this->photo($request);
            return redirect('/dashboard/product')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/dashboard/product')->with($res['status'],$res['message']);
        }else{
            return redirect('/dashboard/product')->with("info","Submit not found");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'category_id'=>'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
        ]);

        //Check category
        if(!Category::find($request->category_id)){
            return ['status'=>'error','message'=>'Kategori tidak ditemukan'];
        }

        // Create product
        Product::create($validatedData);
        return ['status'=>'success','message'=>'Produk berhasil ditambahkan']; 
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'category_id'=>'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
        ]);
        
        //Check if product is found
        if(Product::find($request->id)){
            //Check category
            if(!Category::find($request->category_id)){
                return ['status'=>'error','message'=>'Kategori tidak ditemukan'];
            }
            // Update product
            Product::find($request->id)->update($validatedData);   
            return ['status'=>'success','message'=>'Produk berhasil diedit']; 
        }else{
            return ['status'=>'error','message'=>'Produk tidak ditemukan'];
        }
    }

    public function photo(Request $request){
        
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'image' => 'image|file|max:1024',
        ]);
  
        $product = Product::find($request->id);

        //Check if product is found
        if(Product::find($request->id)){
            if($request->file('image')){
                $validatedData['image'] = $request->id.".png";
                $request->file('image')->move(public_path('assets/img/product/'), $validatedData['image']);
                $product->update($validatedData);
                return ['status'=>'success','message'=>'Foto berhasil diedit']; 
            }else{
                return ['status'=>'error','message'=>'Foto gagal diedit'];
            }
        }else{
            return ['status'=>'error','message'=>'Produk tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $product = Product::find($request->id);

        //Check if the product is found
        if($product){
            // Delete photo
            if($product->image){
                $image_path = public_path().'/assets/img/product/'.$product->image;
                unlink($image_path);         // Delete product image
            }
            Product::destroy($request->id);  // Delete product
            return ['status'=>'success','message'=>'Produk berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Produk tidak ditemukan'];
        }

        //Check if the user is found
        if($user){
            $user->career()->delete();          // Delete career
            $user->certification()->delete();   // Delete certification
            $user->cooperation()->delete();     // Delete cooperation
            $user->transaction()->delete();     // Delete transaction
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
