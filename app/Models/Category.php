<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //asignacion masiva
    protected $fillable = ['name','slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //uno a muchos
    public function post(){
        return $this->hasMany(Post::class);
    }
}
