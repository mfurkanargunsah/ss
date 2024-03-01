<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    protected $table = 'purchases';
   

    public static function getNextSequence()
    {
        $invoice = Purchases::orderByDesc('id')->first();
        return $invoice ? $invoice->invoice_no + 1 : 10000000;
    }
}
