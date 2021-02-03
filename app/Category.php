<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
    ];
    public function items(){
        return $this->hasMany('App\Item');
    }
    public function getNumberOfItem($item){
return $item->count();
    }
}
