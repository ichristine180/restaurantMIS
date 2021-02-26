<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'itemId',
        'itemDisCount',
        'status',
        'tableId',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tables()
    {
        return $this->belongsTo(Tables::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Orders::class,'cancel_order','userId','orderId','reason');
    }
}
