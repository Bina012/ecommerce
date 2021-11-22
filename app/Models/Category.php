<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name','slug','rank','short_description','description','meta_description','image','meta_title','meta_description','meta_keyword','status','created_by','updated_by'];
}
