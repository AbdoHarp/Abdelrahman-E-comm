<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Product_Image;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'categroy_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
        'featured',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categroy_id', 'id');
    }
    public function productImages()
    {
        return $this->hasMany(Product_Image::class, 'product_id', 'id');
    }
    public function productColors()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }
}
