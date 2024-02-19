<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUlids, HasFactory;

    protected $table = "products";

    protected $fillable = [
        'name',
        'picture',
        'price',
        'stock'
    ];
}
