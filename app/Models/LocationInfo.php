<?php

namespace App\Models;

use App\Http\Controllers\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationInfo extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = '1';
    const STATUS_DEACTIVATE = '0';
    const STATUS = [
        self::STATUS_ACTIVE,
        self::STATUS_DEACTIVATE,
    ];
    protected $table = 'location_infos';
    protected $fillable = [
        'name',
        'index',
        'address',
        'phone',
        'cat_id',
        'desc',
        'image',
        'files',
        'video',
        'tags',
        'status',
    ];
    protected $casts = [
        'image' => 'array',
        'files' => 'array',
        'video' => 'array',
        'tags' => 'array',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'location_id', 'id');
    }
}
