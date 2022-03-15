<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transactionDetails';

    public $timestamps = false;

    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
