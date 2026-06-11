<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'language',
        'date',
        'paymethod',
        'status',
        'reason'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
