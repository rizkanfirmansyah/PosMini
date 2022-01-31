<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    use Timestamp;

    protected $table = 'suppliers';
    protected $fillable = ['name', 'address', 'phone', 'email', 'created_by'];
}
