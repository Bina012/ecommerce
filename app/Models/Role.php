<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name','key','status','created_by','updated_by'];

    function  permissions(){
        return $this->belongsToMany(permission::class);
    }
}
