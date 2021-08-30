<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }
    protected function isValidPrice($request){
        if($request->input('price') != 0 && $request->input('price_sale') != 0 && $request->input('price_sale')>= $request->input('price')){
            Session::flash('error','Giá Sale phải nhỏ hơn giá gốc');
            return false;
        }
        if($request->input('price') != 0 && (int)$request->input('price') == 0)
        {
            Session::flash('error','Giá Sale phải nhỏ hơn giá gốc');
            return false;
        }
        return true;
    }
    public function insert($request){
        $isValidPrice=$this->isValidPrice($request);
        if($isValidPrice === false){
            return false;
        }
        try{
            $request->except('_token');
            Product::create($request->all());
           
            Session::flash('success','Thêm sản phẩm thành công');
        }catch(\Exception $err){
            Session::flash('thongbao','Thêm sản phẩm lỗi');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
        
    }
    public function get()
    {
        return Product::with('menu')
            ->orderByDesc('id')->paginate(15);
    }
    public function update($request,$product){
        $isValidPrice=$this->isValidPrice($request);
        if($isValidPrice === false){
            return false;
        }

        try{
            $product->fill($request->input());
             $product->save();
             Session::flash('success','Cập nhập thành công');
        }catch(\Exception $err){
            Session::flash('thongbao','Cập nhập thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        
    }
}