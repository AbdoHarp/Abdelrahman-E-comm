<?php

namespace App\Models;

use App\Models\product;
use App\Models\productcolor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    use HasFactory;

    protected $table = 'orders_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id', 'id');
    }

    public function productcolor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id');
    }
}
