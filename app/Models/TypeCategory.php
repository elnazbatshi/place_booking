<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCategory extends Model
{
    use HasFactory;

    protected $table = 'type_category';
    protected $fillable = [
        'name',
        'type',
        'image',
        'desc',
    ];
    const TYPE_BOOK = 'book';
    const TYPE = [
        self::TYPE_BOOK,
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'type_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'categoryType', 'id');
    }

}
