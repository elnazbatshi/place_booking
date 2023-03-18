<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_file');
    }

}
