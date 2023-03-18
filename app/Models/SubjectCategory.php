<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubjectCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'tag',
        'imageIndex',
        'book_id',
    ];

    public function getAttribute($key)
    {
        if (Str::endsWith($key, '_fa') && $this->isDateAttribute($date = Str::substr($key, 0, -3))) {
            return verta($this->getAttribute($date))->format('j F Y');
        }
        return parent::getAttribute($key);
    }

    public function book()
    {
        return $this->belongsTo(Category::class, 'book_id', 'id');
    }
}
