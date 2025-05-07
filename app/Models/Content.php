<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
     protected $table = 'contents';
     protected $primaryKey = 'id';
     protected $fillable = ['tittle','text'];
     public $timestamps;

   //   public function category_contents(){
   //      return $this->hasMany(CategoryContent::class);
   //   }
     public function categories(){
      return $this->belongsToMany(Category::class, 'category_contents');
  }
}
