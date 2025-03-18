<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',


    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function discount()
    {
        return $this->hasMany(Discount::class);
    }
    public function category_vendor()
    {
        return $this->hasMany(Category_Vendor::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
