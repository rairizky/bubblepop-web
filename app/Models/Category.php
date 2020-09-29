<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = ['name'];
    protected $guard = [] ;

    public function menu() {
        return $this->hasMany('App\Models\Menu');
    }

    public function topping() {
        return $this->hasMany('App\Models\Topping');
    }
}
