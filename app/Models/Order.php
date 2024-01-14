<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order'; // Tên của bảng trong cơ sở dữ liệu
    protected $primaryKey = 'id'; // Khóa chính của bảng
    protected $fillable = ['username', 'id_shipping_address', 'payment_methods', 'created_at', 'updated_at'];

    public function orderDetail()
    {
        return $this->hasMany(Order_Detail::class, 'id_order_detail');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username');
    }
}
