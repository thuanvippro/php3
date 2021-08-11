@extends('admin.layouts.main')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Danh mục</label>
                <select name="cate_id" class="form-control">
                    @foreach($category as $v)
                        <option value="{{$v->id}}" {{$product->cate_id == $v->id ? "selected" : ""}}>{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Giá</label>
                <input type="text" name="price" class="form-control" value="{{$product->price}}">
                @error('price')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Giá sale</label>
                <input type="text" name="sale_price" class="form-control" value="{{$product->sale_price}}">
            </div>
            <div class="form-group">
                <label for="">Số lượng</label>
                <input type="text" name="quantity" class="form-control" value="{{$product->quantity}}">
                @error('quantity')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Thẻ Tags</label><br>
                @foreach($tags as $tag)
                    <input type="checkbox" id="vehicle1" name="product_tag[]" @foreach($product->productTag as $pt)  @if($tag->id == $pt->id){{'checked'}}@endif @endforeach value="{{$tag->id}}">
                    <label for="vehicle1">{{$tag->name}}</label><br>
                @endforeach
            </div>
        </div>
        <div class="col-6">
            <div class="add-product-preview-img">
                <img class="form-control" type="file" name="image" src="" alt="your image" />
            </div>
            <div class="form-group">
                <label for="">Ảnh sản phẩm</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Cân Nặng</label>
                <input type="text" name="weight" class="form-control" value="{{$product->weight}}">
                @error('weight')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <input type="hidden" name="removeGalleryIds" value="">
            <table class="table table-stripped">
                <thead>
                    <th>File</th>
                    <th>Thumbnail</th>
                    <th>
                        <button class="btn btn-success add-img" type="button">Thêm ảnh</button>
                    </th>
                </thead>
                <tbody id="gallery">
                    @foreach ($product->productImage as $gl)
                    <tr id="{{$gl->id}}">
                        <td>{{$gl->url}}</td>
                        <td>
                            <img src="{{asset('storage/' . $gl->url)}}" width="80">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="removeGalleryImg(this, {{$gl->id}})">Xóa</button>
                        </td>
                    </tr>
                        
                    @endforeach
                </tbody>
            </table>    
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Mô tả ngắn sản phẩm:</label>
                <textarea name="short_description" class=form-control  rows="10">{{old('short_description')}}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="">Chi tiết sản phẩm:</label>
                <textarea name="detailed_description" class=form-control  rows="10">{{old('detailed_description')}}</textarea>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{route('listProduct')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
    
</form>
<br>
@endsection
@section('pagejs')
<script>
    $(document).ready(function(){
        $('.add-img').click(function(){
            var rowId = Date.now();
            $('#gallery').append(`
                <tr id="${rowId}">
                    <td>
                        <div class="form-group">
                            <input row_id="${rowId}" type="file" name="product_image[]" class="form-control" onchange="loadFile(event, ${rowId})">
                        </div>
                    </td>
                    <td>
                        <img row_id="${rowId}" src="" width="80">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="removeGalleryImg(this)">Xóa</button>
                    </td>
                </tr>
            `);
        })
    })
    function removeGalleryImg(el, galleryId = 0){
        $(el).parent().parent().remove();
        if(galleryId != 0){
            let removeIds = $(`[name="removeGalleryIds"]`).val();
            removeIds += `${galleryId}|`
            $(`[name="removeGalleryIds"]`).val(removeIds);
        }
    }  
    function loadFile(event, el_rowId) {
            var reader = new FileReader();
            var output = document.querySelector(`img[row_id="${el_rowId}"]`);
            reader.onload = function(){
                output.src = reader.result;
            };
            if(event.target.files[0] == undefined){
                output.src = "";
                return false;
            }else {
                reader.readAsDataURL(event.target.files[0]);
            }
        }; 
</script>

@endsection