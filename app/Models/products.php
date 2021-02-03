<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    public $timestamps = false;
    //
    protected $table = 'products';
    protected $fillable = [
        'name',
        'unit_price',
        'images'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
