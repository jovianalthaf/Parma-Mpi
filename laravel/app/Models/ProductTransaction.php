<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    // SETIAP PRODUCT TRANSACTION DIMILIKI USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
