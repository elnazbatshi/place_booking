<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_ANSWERED = 'answered';
    const STATUS = [

        self::STATUS_PENDING,
        self::STATUS_ANSWERED,
    ];
    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'subject',
        'message',
        'status',
    ];
    use HasFactory;
}
