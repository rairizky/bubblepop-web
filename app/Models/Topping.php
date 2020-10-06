<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    protected $table = "toppings";
    protected $fillable = ['name', 'image', 'price', 'category_id', 'description', 'status'];
    protected $guard = [] ;

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function extra_item() {
        return $this->hasMany('App\Models\Extra');
    }
}
