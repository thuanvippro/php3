<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProduct;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index(Request $request){
        $pagesize = config('common.default_page_size');
        $productQuery = Product::where('name', 'like', "%".$request->keyword."%");
        if($request->has('cate_id') && $request->cate_id > 0){
            $productQuery = $productQuery->where('cate_id', $request->cate_id);
        }
        // if($request->has('tag_id')){
        //     $productQuery = Tag::JOIN($productQuery);
        // }
        if($request->has('order_by') && $request->order_by > 0){
            if($request->order_by == 1){
                $productQuery = $productQuery->orderBy('name');
            }else if($request->order_by == 2){
                $productQuery = $productQuery->orderByDesc('name');
            }else if($request->order_by == 3){
                $productQuery = $productQuery->orderBy('price');
            }else if($request->order_by == 4){
                $productQuery = $productQuery->orderByDesc('price');
            }else if($request->order_by == 5){
                $productQuery = $productQuery->orderBy('quantity');
            }else{
                $productQuery = $productQuery->orderByDesc('quantity');
            }
        }
        // $products = Product::orderBy('id')->paginate(20);
        $category = Category::all();
        $tags = Tag::all();
        $products = $productQuery->paginate($pagesize);
        $products->appends($request->except('page'));
        // $products = $productQuery->get();
        return view('admin/products.index', compact('products', 'category', 'tags'));
    }
    public function addFormProduct(){
        $category = Category::all();
        $tags = Tag::all();
        return view('admin/products.add-form', compact('category', 'tags'));
    }
    public function editFormProduct($id){
        $product = Product::find($id); 
        if(!$product){
            return redirect()->back();
        }
        $category = Category::all();
        $tags = Tag::all();
        // dd($product->productTag);
        return view('admin/products.edit-form', compact('category', 'product', 'tags'));
    }
    public function saveAddProduct(ProductRequest $request){
        // dd($request->product_tag);
        $model = new Product();
        $model->fill($request->all());
        if($request->has('image')){
            $newImage = uniqid(). '-' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/uploads/products', $newImage);
            $model->image = str_replace('public/', '', $path);
            // $model->image = $request->file('image')->storeAs('uploads/products', uniqid() . '-' . $request->image->getClientOriginalName());
        }
        $model->save();
        if($request->has('product_tag')){
            foreach($request->product_tag as $dataProTag){
                $proTag = new ProductTag();
                $proTag->product_id = $model->id;
                $proTag->tag_id = $dataProTag;
                $proTag->save();
            }
        }
        if($request->has('product_image')){
            foreach($request->product_image as $item){
                $modelProImg = new ProductImage();
                $modelProImg->product_id = $model->id;
                $newImage = uniqid(). '-' . $item->getClientOriginalName();
                $path = $item->storeAs('public/uploads/products/galleries/', $newImage);
                $modelProImg->url = str_replace('public/', '', $path);
                // $modelProImg->url = $item->storeAs('uploads/products/galleries/' . $model->id , 
                //                         uniqid() . '-' . $item->getClientOriginalName());
                $modelProImg->save();
            }
        }
        return redirect(route('listProduct'));
    }
    public function saveEditProduct($id, EditProduct $request){
        $product = Product::find($id); 
        foreach($product->productTag as $pt){
            ProductTag::where('tag_id', $pt->id)->where('product_id', $id)->delete();
        }
        $product->fill($request->all());
        if($request->has('image')){
            $newImage = uniqid(). '-' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/uploads/products', $newImage);
            $product->image = str_replace('public/', '', $path);
            // $model->image = $request->file('image')->storeAs('uploads/products', uniqid() . '-' . $request->image->getClientOriginalName());
        }
        $product->image = $product->image;
        $product->save();
        
        if($request->has('product_tag')){
            foreach($request->product_tag as $dataProTag){
                $proTag = new ProductTag();
                $proTag->product_id = $product->id;
                $proTag->tag_id = $dataProTag;
                $proTag->save();
            }
        }
        if($request->has('removeGalleryIds')){
            $strIds = rtrim($request->removeGalleryIds, '|');
            $lstIds = explode('|', $strIds);
            $removeList = ProductImage::whereIn('id', $lstIds)->get();
            foreach ($removeList as $gl) {
                Storage::delete($gl->url);
            }
            
            ProductImage::destroy($lstIds);
        }

        if($request->has('product_image')){
            foreach($request->product_image as $item){
                $modelProImg = new ProductImage();
                $modelProImg->product_id = $product->id;
                $newImage = uniqid(). '-' . $item->getClientOriginalName();
                $path = $item->storeAs('public/uploads/products/galleries/', $newImage);
                $modelProImg->url = str_replace('public/', '', $path);
                // $modelProImg->url = $item->storeAs('uploads/products/galleries/' . $model->id , 
                //                         uniqid() . '-' . $item->getClientOriginalName());
                $modelProImg->save();
            }
        }
        return redirect(route('listProduct'));
    }
    public function deleteProduct($id){
        $product = Product::find($id); 
        foreach($product->productTag as $pt){
            ProductTag::where('tag_id', $pt->id)->where('product_id', $id)->delete();
        }
        ProductImage::where('product_id', $id)->delete();
        Product::destroy($id);
        return redirect()->back();
    }
}
