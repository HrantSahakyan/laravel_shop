<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'category_id',
        'price',
        'sale_price',
        'quantity',
        'status'
    ];

    public function getCategory()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
