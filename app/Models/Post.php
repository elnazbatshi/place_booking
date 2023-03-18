<?php

namespace App\Models;

use App\Models\Scopes\PostScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVATE = 'deactivate';
    const STATUS_CHOICE_ADMIN = 'admin choice';
    const PRIVACY_PUBLIC = 'public';
    const PRIVACY_PRIVATE = 'private';
    const STATUS = [
        self::STATUS_ACTIVE,
        self::STATUS_DEACTIVATE,
        self::STATUS_CHOICE_ADMIN,
    ];
    const PRIVACY = [
        self::PRIVACY_PUBLIC,
        self::PRIVACY_PRIVATE,

    ];

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'semiContent',
        'tags',
        'imageIndex',
        'audio',
        'video',
        'categoryType',
        'status',
        'privacy',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new PostScope());
    }

//    protected $appends = ['jalali_date'];

    protected $casts = [
        'tags' => 'array',

    ];


    public function getAttribute($key)
    {
        if (Str::endsWith($key, '_fa') && $this->isDateAttribute($date = Str::substr($key, 0, -3))) {
            return verta($this->getAttribute($date))->format('j F Y');
        }
        return parent::getAttribute($key);
    }
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriables');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'post_file');
    }

    public function postType()
    {
        return $this->belongsTo(TypeCategory::class, 'categoryType', 'id');
    }
}
