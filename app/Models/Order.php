<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $fillable = ['name', 'user_id', 'cashier', 'total', 'paid', 'status'];
    protected $guard = [];
}
