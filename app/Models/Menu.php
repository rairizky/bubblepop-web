<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";
    protected $fillable = ['name', 'image', 'price_m', 'price_l', 'category_id', 'description', 'status'];
    protected $guard = [] ;

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function detail_order() {
        return $this->hasOne('App\Models\Detail');
    }
}
