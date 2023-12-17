<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product'; // Tên của bảng trong cơ sở dữ liệu
    protected $primaryKey = 'id'; // Khóa chính của bảng
    protected $fillable = ['name_product', 'name_shop', 'id_category_child', 'description', 'created_at', 'updated_at'];

    public function category_child()
    {
        return $this->belongsTo(Category_Child::class, 'id_category_child');
    }

    public function productDetail()
    {
        return $this->hasMany(Product_Detail::class, 'id_product');
    }
}
