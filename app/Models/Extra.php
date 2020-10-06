<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;

    protected $table = "extras";
    protected $fillable = ['order_id', 'detail_id', 'topping_id', 'extra_for'];
    protected $guard = [];

    public function detail_item() {
        return $this->belongsTo('App\Models\Detail');
    }

    public function topping_item() {
        return $this->belongsTo('App\Models\Topping');
    }

    public function order_inv() {
        return $this->belongsTo('App\Models\Order');
    }
}
