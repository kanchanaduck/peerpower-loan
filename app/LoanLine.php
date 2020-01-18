<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanLine extends Model
{
    protected $fillable = ['loan_header_id', 'line_no', 'date',	'payment_amount', 
    'principal', 'interest', 'balance', 	'line_status',	'created_by',	'updated_by',	'created_at',	'updated_at'
        ];
}
