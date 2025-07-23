<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
     protected $table = 'contents';
     protected $primaryKey = 'id';
     protected $fillable = ['title','text', 'category_id'];
     public $timestamps = true;

   //   public function category_contents(){
   //      return $this->hasMany(CategoryContent::class);
   //   }
  //    public function categories(){
  //     return $this->belongsToMany(Category::class, 'category_contents');
  // }

  public function category(){
    return $this->belongsTo(Category::class);
  }
}
