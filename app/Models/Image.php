<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use App\Functions\Core;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'target_id',
        'size',
        'target_type',
        'origin',
        'storage',
    ];

    public static $STORAGE = "IMAGES";
    public static $FILE = null;

    protected static function booted()
    {
        self::creating(function ($Self) {
            $bassename =  basename(Storage::disk('public')->put(self::$STORAGE, self::$FILE));
            $Self->storage = $bassename;
            $Self->origin = self::$FILE->getClientOriginalName();
            $Self->size = self::$FILE->getSize();
        });

        self::deleted(function ($Self) {
            Storage::disk('public')->delete(implode('/', [self::$STORAGE, $Self->storage]));
        });
    }

    public function getLinkAttribute()
    {
        return url(Storage::url(implode('/', [Image::$STORAGE, $this->storage])), [], false);
    }

    public function Target(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'target_type', 'target_id');
    }
}
