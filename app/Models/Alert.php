<?php

namespace App\Models;

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
    ];

    protected $searchable = [
        'vehicle.name_en',
        'name',
        'date',
        'threshold',
        'recurrence',
        'details',
    ];

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle');
    }
}
