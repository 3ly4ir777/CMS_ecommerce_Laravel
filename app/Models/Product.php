<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUlids;

    protected $fillable = ['name', 'description', 'price', 'stock', 'category', 'attributes'];

    protected function casts(): array
    {
        return [
            'attributes' => 'array',
            'price' => 'decimal:2',
        ];
    }
}
