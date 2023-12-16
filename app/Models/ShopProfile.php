<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProfile extends Model
{
    use HasFactory;

    protected $table = 'shop_profile';
    protected $fillable = ['username','name_shop','address','description','cover_image','avt','created_at','updated_at'];

    public function products()
    {
        return $this->hasMany(Product::class); 
    }
   
    public function category_child()
    {
        return $this->hasManyThrough(Category_Child::class, Product::class);
    }
}
