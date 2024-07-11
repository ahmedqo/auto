<?php

namespace App\Models;

use App\Functions\Core;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as MD;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Model extends MD
{
    use HasFactory, HasSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'name_en',
        'description_en',
    ];

    protected $searchable = [
        'name_en',
        'description_en',
    ];

    protected static function booted()
    {
        self::created(function ($Self) {
            Image::$FILE = request('image');
            $Self->Image()->create();
        });

        self::deleted(function ($Self) {
            Storage::disk('public')->delete(implode('/', [Image::$STORAGE, $Self->Image->storage]));
            $Self->Image->delete();
        });
    }

    public function getNameAttribute()
    {
        return $this->{'name_' . Core::lang()};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_' . Core::lang()};
    }

    public function Products()
    {
        return $this->hasMany(Vehicle::class, 'model');
    }

    public function Image(): MorphOne
    {
        return $this->morphOne(Image::class, 'target');
    }
}
