<?php

namespace App\Models;

use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class Order extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVATE = 'deactivate';
    const STATUS_PENDING = 'pending';
    const STATUS = [
        self::STATUS_ACTIVE,
        self::STATUS_DEACTIVATE,
        self:: STATUS_PENDING,
    ];
    protected $table = 'orders';
    protected $fillable = [
        'location_id',
        'user_id',
        'day',
        'startTime',
        'endTime',
        'index',
        'department',
        'desc',
        'form_data',
        'subject',
        'parking',
        'catering',
        'status',
    ];

//    protected $casts=[
//        'day'=>'date',
//    ];


    /*public function getOrderIdAttribute()
    {
        return "order_".$this->getAttribute('id');
    }*/

    protected function orderId(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => "order_".$this->id
        );
    }

    public function getAttribute($key)
    {
        if (Str::endsWith($key, '_fa') && $date = Carbon::createFromFormat('Y-m-d',$this->attributes[Str::substr($key, 0, -3)])) {
            return verta($date)->format('Y-F-j');
        }
        return parent::getAttribute($key);
    }

    public function location()
    {
        return $this->belongsTo(LocationInfo::class, 'location_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'id');
    }

}
