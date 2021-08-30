@extends('admin.main')



@section('content')
@include('admin.alert')
<form action="{{$menu->id}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="card-body">
                    <div class="form-group">
                        <label for="menu">Tên danh mục</label>
                        <input type="text" name="name" value="{{$menu->name}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="form-group">
                        <label >Danh mục</label>
                        <select name="parent_id" class="form-control">
                            <option value="0" {{$menu->parent_id == 0 ? 'selected':''}} >Danh mục cha</option>
                            @foreach($menus as $menuParent)
                                <option value="{{$menuParent->id}}">
                                    {{$menuParent->name}} {{$menu->parent_id == $menuParent->id ? 'selected':''}}
                                </option>
                            @endforeach  
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Mô tả</label>
                        <textarea name="description" id="content" class="form-control">{{$menu->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label >Mô tả chi tiết</label>
                        <textarea name="content" id="content" class="form-control">{{$menu->content}}</textarea>
                    </div>
                    <div class="form-group">  
                        <label>Kích hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{$menu->active == 1 ? 'checked="' : ''}}>
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{$menu->active == 0 ? 'checked="' : ''}}>
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                    </div>
                </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                         <button type="submit" class="btn btn-primary">Sửa danh mục</button>
                    </div>
               
</form>
@endsection
@section('footer')
            <script>
                CKEDITOR.replace('content');
            </script>
@endsection