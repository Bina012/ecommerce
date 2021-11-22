<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['category_id','subcategory_id','title','slug','price','discount','quantity','unit_id','feature_product','flash_product','short_description','description','specification','meta_keyword','meta_description','meta_title','status','created_by','updated_by'];
}
