<?php

namespace App\Models;

use App\Functions\Core;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory, HasSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle',
        'name',
        'details',
        'cost',
        'company',
    ];

    protected $searchable = [
        'vehicle.name',
        'name',
        'details',
        'cost'
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

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle');
    }
}
