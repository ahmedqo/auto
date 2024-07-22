<?php

namespace App\Models;

use App\Functions\Core;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSearch;

class Alert extends Model
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
        'date',
        'threshold',
        'recurrence',
        'details',
        'company',
    ];

    protected $searchable = [
        'vehicle.name',
        'name',
        'date',
        'threshold',
        'recurrence',
        'details',
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
