<?php

namespace App\Models;

use App\Functions\Core;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Vehicle extends Model
{
    use HasFactory, HasSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
        'passengers',
        'milage',
        'doors',
        'cargo',
        'transmission',
        'fuel',
        'slug',
        'name',
        'details',
        'company',
    ];

    protected $searchable = [
        'price',
        'passengers',
        'milage',
        'doors',
        'cargo',
        'transmission',
        'fuel',
        'name',
        'details',
    ];

    protected static function booted()
    {
        self::saving(function ($Self) {
            if (is_null($Self->company)) {
                $Self->company = Core::company()->id;
            }
        });

        self::created(function ($Self) {
            foreach (request('images') as $Image) {
                Image::$FILE = $Image;
                $Self->Images()->create();
            }
        });

        self::deleted(function ($Self) {
            $Self->Images->each(function ($Image) {
                Storage::disk('public')->delete(implode('/', [Image::$STORAGE, $Image->storage]));
                $Image->delete();
            });
        });
    }

    public function Company()
    {
        return $this->hasOne(Company::class, 'id');
    }


    public function Reservations()
    {
        return $this->hasMany(Reservation::class, 'vehicle');
    }

    public function Charges()
    {
        return $this->hasMany(Charge::class, 'vehicle');
    }

    public function Alerts()
    {
        return $this->hasMany(Alert::class, 'vehicle');
    }

    public function Images(): MorphMany
    {
        return $this->morphMany(Image::class, 'target');
    }
}
