<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_Child extends Model
{
    use HasFactory;
    protected $table = 'category_child'; // Tên của bảng trong cơ sở dữ liệu
    protected $primaryKey = 'id'; // Khóa chính của bảng
    protected $fillable = ['name_category_child','id_category','created_at','updated_at'];
}
