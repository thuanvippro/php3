@extends('admin.layouts.main')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @if(Session::has('msg'))
        <div class="alert alert-success" role="alert">
            {{Session::get('msg')}}
        </div>
    @endif
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên người dùng</label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="{{$user->email}}">
                @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            {{-- <div class="form-group">
                <label for="">Quyền cho phép</label><br>
                @foreach($permissions as $p)
                    <input type="checkbox" name="model_has_permissions" id="vehicle1" value="{{$p->name}}">
                    <label for="vehicle1">{{$p->name}}</label><br>
                @endforeach
            </div> --}}
            <div class="form-group">
                <label for="">Vai trò</label><br>
                @foreach($roles as $r)
                    <input type="checkbox" name="model_has_roles" id="vehicle1"  
                    @foreach($user->roles as $x)
                        @if($x->id == $r->id) {{"checked"}}
                        @endif
                    @endforeach 
                    value="{{$r->name}}">
                    <label for="vehicle1">{{$r->name}}</label><br>
                @endforeach
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('listUser')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
    
</form>
<br>
@endsection