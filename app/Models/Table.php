<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['name','location','state'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getLastOrderWithinTwoDays()
    {
        return $this->orders()
            ->where('created_at', '>=', now()->subDays(2)->startOfDay())
            ->where('created_at', '<=', now()->endOfDay())
            ->latest()
            ->first();
    }
}