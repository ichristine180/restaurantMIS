<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = [
        'userId',
        'orderId',
        'status'
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
