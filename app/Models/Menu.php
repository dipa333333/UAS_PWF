<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description',
        'price',
        'discount_price',
        'stock',
    ];

    
    protected $appends = ['is_available'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getIsAvailableAttribute()
    {
        return $this->stock > 0;
    }
}