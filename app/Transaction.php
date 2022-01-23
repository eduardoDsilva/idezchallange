<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $hidden = ['account_id', 'updated_at'];

    protected $fillable = [
        'amount', 'type', 'account_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
