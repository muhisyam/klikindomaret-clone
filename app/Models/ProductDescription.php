<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasFactory;
    
    protected $table = 'product_descriptions';

    protected $fillable = [
        'product_id',
        'title_product_description',
        'product_description',
    ];
}
