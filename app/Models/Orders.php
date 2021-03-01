<?php

namespace App\Models;
use App\Item;
use App\Models\Tables;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'itemId',
        'discount',
        'status',
        'tableId',
        'quantity'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class,'itemId','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }
    public function tables()
    {
        return $this->belongsTo(Tables::class,'tablesId','id');
    }
    
}
