<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model

{
    protected $table = 'requests';

    public function creator(){
        return $this->belongsTo(User::class,'creator_uuid','uuid');
    }
    public function answer()
    {
        return $this->belongsTo(Answer::class, 'id');
    }

    use HasFactory;
}
