<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $fillable = ['name','route','status','created_by','updated_by'];

    function  permissions(){
        return $this->hasMany(permission::class);
    }
}
