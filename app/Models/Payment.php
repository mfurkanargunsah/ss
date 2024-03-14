<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{   
    protected $table = 'payments';
    public static function getNextSequence()
    {
        $invoice = Payment::orderByDesc('id')->first();
        return $invoice ? $invoice->invoice_no + 1 : 10000000;
    }
}
