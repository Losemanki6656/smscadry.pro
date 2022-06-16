<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    public function cadry()
    {
        return $this->belongsTo(Cadry::class);
    }
    public function user_send()
    {
        return $this->belongsTo(User::class,'user_send_id');
    }
    public function user_rec()
    {
        return $this->belongsTo(User::class,'user_rec_id');
    }
    
}
