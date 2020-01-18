<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanHeader extends Model
{
    protected $fillable = ['loan_amount', 'loan_term', 'interest_rate', 
    'start_date', 'created_by', 'updated_by', 'created_at', 'updated_at'
        ];
}
