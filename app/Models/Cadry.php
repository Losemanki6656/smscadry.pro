<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadry extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id','department_id','fullname', 'phone', 'date_med1','date_med2','date_vac1','date_vac2','date_tb1','date_tb2',
    ];
    
    protected $dates = ['date_vac1', 'date_vac2', 'date_med1', 'date_med2', 'date_tb1', 'date_tb2'];
    protected $dateFormat = 'Y-m-d';

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}