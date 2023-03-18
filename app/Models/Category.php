<?php

namespace App\Models;

use App\Http\Controllers\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type_id',
        'img_src',
    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categoriables');
    }

    public function modules()
    {
        return $this->morphedByMany(Module::class, 'categoriables');
    }

    public function multiMorphPost()
    {
        return $this->morphedByMany(MultiMorphPost::class, 'categoriables');
    }

    public function type()
    {
        return $this->belongsTo(TypeCategory::class, 'type_id', 'id');
    }

    public function subject()
    {
        return $this->hasMany(SubjectCategory::class, 'book_id', 'id');
    }

    public function location()
    {
        return $this->hasMany(LocationInfo::class, 'cat_id', 'id');
    }
}
