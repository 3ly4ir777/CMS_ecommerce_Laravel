<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUlids;

    protected $fillable = ['customer_name', 'total', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
