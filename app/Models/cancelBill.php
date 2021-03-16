<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use App\Models\Bills;
class cancelBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'reason',
        'billId',
    ];
    public function bill()
    {
        return $this->belongsTo(Bills::class,'billId','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'userId','id');
    }
}
