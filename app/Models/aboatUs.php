<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aboatUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phoneNumber',
        'address',
        'description',
        'image',
    ];
}
