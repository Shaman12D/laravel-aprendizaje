<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'category_id', 'description', 'posted', 'image', 'user_id'];

    function category() {
        return $this->belongsTo(Category::class); //Lo que hace el belongs to es traer los datos de la tabla hija a los datos de la tabla madre
    }
}
