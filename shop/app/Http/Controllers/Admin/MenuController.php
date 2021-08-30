<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService){
        $this->menuService= $menuService;
    }   
    public function create(){
        return view('admin.menu.add',
            ['title'=>'Thêm danh mục mới',
            'menus'=>$this->menuService->getParent()
        ]);
    }
    public function postCreate(CreateFormRequest $request){
        $result = $this->menuService->create($request);
        return redirect()->back();
    }

    public function getList(){
        return view('admin.menu.list',[
            'title'=>'Danh sách danh mục mới nhất',
            'menus'=>$this->menuService->getAll()
        ]);
    }
    public function deleteList($id){
        $menu = Menu::find($id);
        $menu->delete();
        return redirect('admin/menu/list')->with('success','Xóa thành công');
    }
    public function getEdit(Menu $menu){
        return view('admin.menu.edit',[
            'title'=>'Chỉnh sửa danh mục :'.$menu->name,
            'menu'=>$menu,
            'menus'=>$this->menuService->getParent()
        ]);
    }
    public function postEdit(CreateFormRequest $request,Menu $menu){
        $this->menuService->update($request,$menu);

        return redirect('admin/menu/list');
    }
      
    
}
