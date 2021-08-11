<h2>Thông tin danh mục</h2>
<p>Tên danh mục: {{$cate->name}}</p>
<p>Số lượng sản phẩm: {{count($cate->products)}}</p>
<ul>
    @foreach($cate->products as $p)
    <li>{{$p->name}}</li>
    @endforeach
</ul>
{{$schoolname}}