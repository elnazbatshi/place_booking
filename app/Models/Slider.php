<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';
    protected $fillable = [
        'title',
        'content',
        'img_src',
        'status',
        'url',
    ];

    public function getAttribute($key)
    {
        if (Str::endsWith($key, '_fa') && $this->isDateAttribute($date = Str::substr($key, 0, -3))) {
            return verta($this->getAttribute($date))->format('j F Y');
        }
        return parent::getAttribute($key);
    }

    public function scopeStatus($query, $value)
    {
        return $query->where('status', $value);
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriables');
    }
}
