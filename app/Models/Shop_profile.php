<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop_profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_shop',
        'username',
        'address',
        'description',
        'cover_image',
        'avt'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function category_child()
    {
        return $this->hasManyThrough(Category_Child::class, Product::class);
    }
}
