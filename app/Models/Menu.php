<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $fillable = [
        'name',
        'status',
        'logo_image',
        'description',
    ];

    public function MenuItem()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id')->orderBy('index', 'asc');
    }

    public function parents()
    {
        return $this->hasMany(MenuItem::class, 'menu_id');
    }


}
