<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MainUController extends Controller
{
    public function index(){
        $menu = Menu::select('name','id')->where('parent_id',0)->orderByDesc('id')->get();
        return view('main',[
            'title'=>'SHop làm ăn chân chính',
            'menu'=>$menu
        ]);
    }
}
