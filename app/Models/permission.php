<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = ['module_id','name','route','status','created_by','updated_by'];

    function  roles(){
        return $this->belongsToMany(role::class);
    }
}
