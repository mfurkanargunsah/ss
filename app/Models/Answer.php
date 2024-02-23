<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = ['request_id', 'title','creator','category','message'];

    public function files()
    {
        return $this->hasOne(AnswerFiles::class, 'request_id');
    }
}
