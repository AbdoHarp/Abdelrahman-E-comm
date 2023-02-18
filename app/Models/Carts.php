<?php

namespace App\Models;

use App\Models\product;
use App\Models\productcolor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carts extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        "user_id",
        "product_id",
        "product_color_id",
        "quantity"
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class, 'product_id', 'id');
    }
    public function productcolor(): BelongsTo
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id');
    }
}
