<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $guard = "customer";
    protected $fillable=[
        'name',
        'email',
        'phone',
        'mobile_number',
        'department',
        'image',
        'personal_id',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token'

    ];


    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }


}
