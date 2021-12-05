<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['category_id','subcategory_id','title','slug','price','discount','quantity','unit_id','feature_product','flash_product','short_description','description','specification','meta_keyword','meta_description','meta_title','status','created_by','updated_by'];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function productAttributes(){
        return $this->hasMany(ProductAttribute::class);
    }

    public function productImage(){
        return $this->hasMany(ProductImage::class);
    }
}
