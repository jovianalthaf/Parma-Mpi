<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    // SETIAP PRODUK DIMILIKI 1 KATEGORI
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
