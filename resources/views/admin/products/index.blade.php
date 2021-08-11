@extends('admin.layouts.main')

@section('content')
@php
    // use Illuminate\Support\Facades\Auth;
@endphp
{{-- @dump(Auth::user()) --}}
<form action="" method="get">
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
                    @foreach($category as $c)
                    <option @if(isset($searchData['cate_id']) && $c->id == $searchData['cate_id']) selected @endif value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="">Tag</label>
                <select class="form-control" name="tag_id" >
                    <option value="">Tất cả</option>
                    @foreach($tags as $t)
                    <option  value="{{$t->id}}">{{$t->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Sắp xếp theo</label>
                <select class="form-control" name="order_by" >
                    <option value="0">Mặc định</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 1) selected @endif  value="1">Tên alphabet</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 2) selected @endif value="2">Tên giảm dần alphabet</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 3) selected @endif value="3">Giá tăng dần</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 4) selected @endif value="4">Giá giảm dần</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 5) selected @endif value="3">Số lượng tăng dần</option>
                    <option @if(isset($searchData['order_by']) &&  $searchData['order_by'] == 6) selected @endif value="4">Số lượng giảm dần</option>
                </select>
            </div>
            <div class="text-center">
                <br>
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <table class="table table-striped">
        <thead>
            <th>STT</th>
            <th>Tên Sản Phẩm </th>
            <th>Ảnh</th>
            <th>Danh Mục</th>
            <th>Giá</th>
            <th>Giá Sale</th>
            <th>Số Lượng</th>
            <th>Cân Nặng</th>
            <th>Tags</th>
            <th>Đánh Giá Sao</th>
            <th>Lượt Xem</th>
            <th>Lượt Thích</th>
            @can('add product')
                <th>
                    <a href="{{route('addProduct')}}" class="btn btn-primary">Tạo mới</a>
                </th>
            @endcan
        </thead>
        <tbody>
            @foreach($products as $val)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$val->name}}</td>
                <td><img src="{{asset('storage/'. $val->image)}}" width="70" /></td>
                <td>{{$val->category->name}}</td>
                <td>{{$val->price}}</td>
                <td>{{$val->sale_price}}</td>
                <td>{{$val->quantity}}</td>
                <td>{{$val->weight}}</td>
                <td>
                    @foreach($val->productTag as $v)
                        <span style="border: 1px solid #ccc">{{$v->name}}</span><br>
                    @endforeach
                </td>
                <td>{{$val->starts}}</td>
                <td>{{$val->views}}</td>
                <td>{{$val->likes}}</td>
                @can('edit product')
                    <td>
                        <a href="{{route('edit.product',['id'=>$val->id])}}" ><button style="border-radius: 6px;" type="button" class="btn btn-secondary"><i class="far fa-edit" ></i></button></a>
                        <a href="{{route('delete.product',['id'=>$val->id])}}" ><button style="border-radius: 6px;"  type="button" class="btn btn-danger btn-remove"> <i class="fas fa-trash-alt"></i></button></a>
                    </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{$products->links()}}
    </div>
</div>
@endsection