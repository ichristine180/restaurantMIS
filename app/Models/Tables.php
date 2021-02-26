<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;
    protected $fillable=[
        'code'
    ];
    protected function generateCode($id){
        $code =str_pad($id, 4, '0', STR_PAD_LEFT);
        return $code;
    }
}
