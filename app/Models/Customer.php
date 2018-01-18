<?php

namespace App\Models;



use \App\Model;

class Customer extends Model
{
    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = [
        'customerId',
        'name',
    ];


}
