<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    protected $table = ('category_contents');
    protected $primaryKey = ('id');
    public $timestamps; 

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function content(){
        return $this->belongsTo(Content::class);
    }

}
