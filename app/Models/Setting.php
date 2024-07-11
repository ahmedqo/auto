<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'group',
        'content',
    ];

    public static function findBy($value, $type = 'type')
    {
        return Setting::where($type, $value)->first();
    }

    public static function filterBy($value, $type = 'type')
    {
        return Setting::findBy($value, $type)->content;
    }
}
