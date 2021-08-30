<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\product\ProductAdminService;
use App\Models\Product;
use App\Http\Requests\Product\ProductRequest;

class ProductController extends Controller
{
    
    protected $productAdminService;
    public function __construct(ProductAdminService $productAdminService){
        
        $this->productAdminService = $productAdminService;
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.product.add',
            ['title'=>'Thêm sản phẩm mới',
            'menus' => $this->productAdminService->getMenu()
        ]);
    }
    public function postCreate(ProductRequest $request){
        $this->productAdminService->insert($request);
        return redirect()->back();
    }
   
    public function getList()
    {
        return view('admin.product.list',[
            'title'=>'Danh sách sản phẩm',
            'products'=>$this->productAdminService->get()
        ]);
    }

    public function getEdit(Product $product)
    {
        return view('admin.product.edit',[
            'title'=>'Chỉnh sủa sản phẩm',
            'product'=>$product,
            'menus'=>$this->productAdminService->getMenu()    
        ]);
    }

    
    public function postEdit(Request $request,Product $product)
    {
        $result = $this->productAdminService->update($request,$product);
        if($result){
            return redirect('admin/products/list');
        }
        else
            return redirect()->back();
    }

    
    public function destroy($id)
    {
        $pro = Product::find($id);
        $pro->delete();
        return redirect('admin/products/list')->with('success','Xóa thành công');
    }
}
