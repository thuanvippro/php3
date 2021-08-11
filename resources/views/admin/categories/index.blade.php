@extends('admin.layouts.main')

@section('content')
@php
    // use Illuminate\Support\Facades\Auth;
@endphp
{{-- @dump(Auth::user()) --}}
{{-- <form action="" method="get">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input class="form-control" type="text" name="keyword" @isset($searchData['keyword']) value="{{$searchData['keyword']}}" @endisset>
            </div>
            <div class="form-group">
                <label for="">Danh mục sản phẩm</label>
                <select class="form-control" name="cate_id" >
                    <option value="">Tất cả</option>
                    @foreach($cates as $c)
                    <option @if(isset($searchData['cate_id']) && $c->id == $searchData['cate_id']) selected @endif value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Sắp xếp theo</label>
                <select class="form-control" name="order_by" >
                    <option value="0">Mặc định</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 1) selected @endif  value="1">Tên alphabet</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 2) selected @endif value="2">Tên giảm dần alphabet</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 3) selected @endif value="3">Giá tăng dần</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 4) selected @endif value="4">Giá giảm dần</option>
                </select>
            </div>
            <div class="text-center">
                <br>
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form> --}}
<div class="row">
    <table class="table table-striped">
        <thead>
            <th>STT</th>
            <th>Tên Danh Mục</th>
            <th>Ngày tạo</th>
            <th>Ngày sửa</th>
            @can('add category')
                <th>
                    <a href="{{route('addCategory')}}" class="btn btn-primary">Tạo mới</a>
                </th>
            @endcan
        </thead>
        <tbody>
            @foreach($categories as $val)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$val->name}}</td>
                <td>{{$val->created_at}}</td>
                <td>{{$val->updated_at}}</td>
                @can('edit category')
                    <td>
                        <a href="{{route('editCategory',['id'=>$val->id])}}" ><button style="border-radius: 6px;" type="button" class="btn btn-secondary"><i class="far fa-edit" ></i></button></a>
                        <a href="{{route('delete.category',['id'=>$val->id])}}" ><button style="border-radius: 6px;"  type="button" class="btn btn-danger btn-remove"> <i class="fas fa-trash-alt"></i></button></a>
                    </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{-- {{$products->links()}} --}}
    </div>
</div>
@endsection