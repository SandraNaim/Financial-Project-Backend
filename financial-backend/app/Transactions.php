<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
    
    protected $fillable = [
        'title', 'description', 'amount', 'category_id', 'start_date',
         'end_date', 'user_id', 'interval', 'type', 'currency_id', ''
       ];
}
