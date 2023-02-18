<?php

namespace App\Models;

use App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = "_wishlists";
    protected $fillable = [
        'user_id',
        'product_id'
    ];
    public function product()
    {
        return $this->belongsTo(product::class, 'product_id', 'id');
    }
}
