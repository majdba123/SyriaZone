<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_category_id',
        'name',
        'discription',
        'price',


    ];
    public function subcategory()
    {
        return $this->belongsTo(Sub_Categort::class,'sub_category_id');
    }
    public function discount()
    {
        return $this->hasOne(Discount::class);
    }
    public function order_product()
    {
        return $this->hasMany(Order_Product::class);
    }
}
