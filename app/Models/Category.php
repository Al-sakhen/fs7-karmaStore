<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded=[];



    // ==========================
    // Relations
    // ==========================
    public function parent(){
        return $this->belongsTo(Category::class , 'aprent_id' ,'id');
    }

    public function childrens(){
        return $this->hasMany(Category::class , 'parent_id' , 'id')->withCount('products'); // return products_count
    }

    public function products(){
        return $this->hasMany(Product::class );
    }
}
