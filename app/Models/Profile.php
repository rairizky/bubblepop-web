<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = "profiles";
    protected $fillable = ['user_id', 'image', 'phone', 'address'];
    protected $guard = [];

    public function order_user() {

        return $this->belongsTo('App\Models\Order');
    }
}
