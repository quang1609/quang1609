@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tiêu đề</th>
            <th>Link</th>
            <th>Ảnh</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            @foreach($sliders as $key => $slide)
            <tr>
                <td>{{ $slide->id }}</td>
                <td>{{ $slide->name }}</td>
                <td>{{ $slide->url }}</td>
                <td><a href="{{ $slide->thumb }}" target="_blank">
                    <img src="{{ $slide->thumb }}" alt="">
                </a></td>
                
                <td>{!! \App\Helpers\Helper::active($slide->active) !!}</td>
                <td>{{ $slide->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="edit/{{ $slide->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="delete/{{$slide->id}}" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $sliders->links() !!}
    </div>
@endsection