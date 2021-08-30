@extends('admin.main')
@section('content')
<form action="" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="menu">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục" value="{{ $product->name }}" >
                    </div>
                    <div class="form-group">
                        <label >Danh mục</label>
                        <select name="menu_id" class="form-control">
                            <option value="0">Danh mục cha</option>
                            @foreach($menus as $menu)
                                <option value="{{$menu->id}}" {{$product->menu_id == $menu->id ? 'selected' : ''}}>{{$menu->name}}</option>
                            @endforeach  
                        </select>
                    </div>
                    <div class="form-group">
                        <label >giá gốc</label>
                        <input type="text" name="price"  class="form-control" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label >giá sale</label>
                        <input type="text" name="price_sale"  class="form-control" value="{{ $product->price_sale }}">
                    </div>
                    <div class="form-group">
                        <label >Mô tả</label>
                        <textarea name="description" class="form-control" value="">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label >Mô tả chi tiết</label>
                        <textarea name="content"  class="form-control" value="">{{ $product->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="menu">Ảnh sản phẩm</label>
                        <input type="file" name="thumb" class="form-control" id="upload" value="$product->thumb">
                    </div>
                    
                    <div class="form-group">  
                        <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{$product->active==1?'checked' :''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{$product->active==0?'checked' :''}} >
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                    </div>
                </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                         <button type="submit" class="btn btn-primary">Cập nhập sản phẩm</button>
                    </div>
                @csrf
</form>
@endsection
