<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'income_tax', 'cash_payment', 'payment_method', 'order_id', 'type_receipt', 'payment_date', 'payment_time', 'user_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
