<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public $timestamps = true;

    // public function category_contents()
    // {
    //     return $this->hasMany(CategoryContent::class);
    // }

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'category_contents');
    }
}

