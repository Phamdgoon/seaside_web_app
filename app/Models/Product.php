<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product'; // Tên của bảng trong cơ sở dữ liệu
    protected $primaryKey = 'id'; // Khóa chính của bảng
    protected $fillable = ['name_product','name_shop','id_category_child','description','created_at','updated_at'];
    public function shopProfile()
    {
        return $this->belongsTo(ShopProfile::class, 'name_shop', 'name_shop');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'name_shop', 'name_shop');
    }
}
