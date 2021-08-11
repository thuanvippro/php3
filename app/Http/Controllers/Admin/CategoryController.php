<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    public function addFormCategory(){
        return view('admin.categories.add-form');
    }
    public function editFormCategory($id){
        $category = Category::find($id);
        return view('admin.categories.edit-form', compact('category'));
    }
    public function saveAddCategory(CategoryRequest $request){
        $model = new Category();
        $model->fill($request->all());
        $model->save();
        return redirect(route('listCategory'));
    }
    public function saveEditCategory($id, CategoryRequest $request){
        $category = Category::find($id);
        $category->fill($request->all());
        $category->save();
        return redirect(route('listCategory'));
    }
    public function deleteCategory($id){
        Category::destroy($id);
        return redirect()->back();
    }
}
