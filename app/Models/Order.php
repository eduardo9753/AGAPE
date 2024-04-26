<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['state', 'customer_id', 'table_id', 'user_id'];

    // Definir la relación con Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Definir la relación con la mesa
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    // Definir la relación con OrderDish
    public function orderDishes()
    {
        return $this->hasMany(OrderDish::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
