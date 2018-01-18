<?php

namespace App\Models;


use \App\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'transactionId',
        'customerId',
        'amount',
    ];


}
