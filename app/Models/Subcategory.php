<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    protected $fillable = ['category_id','name','slug','rank','short_description','description','meta_description','image','meta_title','meta_description','meta_keyword','status','created_by','updated_by'];


    function  products(){
        return $this->hasMany(Product::class);
    }
}
