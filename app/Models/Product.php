<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'actual_price',
        'discount_price',
        'image',
        'category_id',  
        'tags',
        'status',
    ];

     // Add this relationship
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    // Single-image approach: no relation to ProductImage.
}
