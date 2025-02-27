<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use App\Models\Orders;
class CancelOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cancel_order';
    protected $fillable = [
        'userId',
        'reason',
        'orderId',
    ];
    public function order()
    {
        return $this->belongsTo(Orders::class,'orderId','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }
}
