<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;

    protected $with = ['children'];

    protected $table = 'menu_items';
    protected $fillable = [
        'menu_id',
        'index',
        'title',
        'parent_id',
        'link',
        'status',
        'icon',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

}
