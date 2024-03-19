<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{   
    protected $table = 'subscriptions';

    public function users()
    {
        return $this->hasMany(User::class, 'user_uuid', 'uuid');
    }
}
