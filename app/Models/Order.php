<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    // use HasUlids;

    // protected $fillable = ['customer_name', 'total', 'status'];

    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'shipping_address',
 
    ];

    protected function casts(): array
    {
        return [
            'total' => 'decimal:2',
            'status' => 'string',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
