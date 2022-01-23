<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $with = ['accounts'];

    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

    protected $fillable = [
        'name', 'email', 'phone_number', 'password', 'document'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'user_id');
    }
}
