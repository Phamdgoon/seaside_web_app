<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProfile extends Model
{
    use HasFactory;

    protected $table = 'shop_profile';
    protected $fillable = ['username', 'name_shop', 'address', 'description', 'cover_image', 'avt', 'created_at', 'updated_at'];

    public function products()
    {
        return $this->hasMany(Product::class, 'name_shop', 'name_shop');
    }

    public function category_childs()
    {
        return $this->hasMany(Category_Child::class, 'name_shop', 'name_shop');
    }
}
