<?php

namespace App\Http\Services\Slider;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;

class SliderService
{
    public function insert($request){
        try{
            // $request->except('_token');
            Slider::create($request->all());
            Session::flash('success','Thêm slider thành công');
        }catch(\Exception $err){
            Session::flash('thongbao','Thêm slider thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get()
    {
        return Slider::
            orderByDesc('id')->paginate(15);
    }
    public function update($request,$slider){
        

        try{
            $slider->fill($request->input());
             $slider->save();
             Session::flash('success','Cập nhập thành công');
        }catch(\Exception $err){
            Session::flash('thongbao','Cập nhập thất bại');
            \Log::info($err->getMessage());
            return false;
        }
        
    }
}