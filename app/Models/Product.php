<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    // use HasUlids;

    // protected $fillable = ['name', 'description', 'price', 'stock', 'category', 'attributes'];

    // protected function casts(): array
    // {
    //     return [
    //         'attributes' => 'array',
    //         'price' => 'decimal:2',
    //     ];
    // }

    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
}
