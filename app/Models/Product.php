<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $fillable = ['name', 'cate_id', 'price', 'sale_price', 'quantity', 'weight', 'short_description', 'detailed_description'];
    public function category(){
        return $this->belongsTo(Category::class, 'cate_id');
    }
    public function productImage(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function productTag(){
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }
}
