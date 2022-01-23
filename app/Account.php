<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $with = ['transactions'];

    protected $hidden = ['user_id', 'created_at', 'updated_at'];

    protected $fillable = [
        'agency', 'number', 'digit', 'name', 'social_reason', 'type', 'document', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_id');
    }
}
