<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = "details";
    protected $fillable = ['order_id', 'menu_id', 'mount', 'size', 'price'];
    protected $guard = [] ;

    public function menu_item() {
        return $this->belongsTo('App\Models\Menu');
    }
}
