<?php

namespace App\Http\Services\Menu;
use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function getParent(){
        return Menu::where('parent_id',0)->get();
    }
    public function create($request){
        try{
             Menu::create([
                'name'=>(string)$request->input('name'),
                'parent_id'=>(int)$request->input('parent_id'),
                'description'=>(string)$request->input('description'),
                'content'=>(string)$request->input('content'),
                'active'=>(string)$request->input('active'),
                
            ]);

            Session::flash('success','Tạo danh mục thành công');
        }catch(\Exception $err){
            Session::flash('thongbao',$err->getMessage());
            return false;
        }
        return true;
    }

    public function update($request,$menu):bool{
        if($request->parent_id != $menu->id){
            $menu->fill($request->input());
            
        }
        $menu->save();
    
        Session::flash('success','Cập nhập thành công');
        return true;
    }

    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);
    }

}