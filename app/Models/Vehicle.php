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
        'mileage',
        'doors',
        'cargo',
        'transmission',
        'fuel',
        'circulation',
        'company',
        'brand',
        'model',
        'horsepower',
        'horsepower_tax',
        'insurance',
        'insurance_cost',
        'registration_type',
        'registration_number',
        'year',
    ];

    protected $searchable = [
        'price',
        'passengers',
        'mileage',
        'doors',
        'cargo',
        'transmission',
        'fuel',
        'circulation',
        'brand',
        'model',
        'horsepower',
        'horsepower_tax',
        'insurance',
        'insurance_cost',
        'registration_type',
        'registration_number',
        'year',
    ];

    protected static function booted()
    {
        self::saving(function ($Self) {
            if (is_null($Self->company)) {
                $Self->company = Core::company()->id;
            }
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
}
