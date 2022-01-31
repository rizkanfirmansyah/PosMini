<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Timestamp;

    protected $table = 'products';
    protected $fillable = ['name', 'description', 'photo', 'price', 'stock_min', 'created_by'];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
