<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use Timestamp;

    protected $table = 'customers';
    protected $fillable = ['name', 'address', 'phone', 'email', 'created_by'];
}
