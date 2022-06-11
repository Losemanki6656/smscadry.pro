<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionMed extends Model
{
    use HasFactory;

    public function cadry()
    {
        return $this->belongsTo(Cadry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
