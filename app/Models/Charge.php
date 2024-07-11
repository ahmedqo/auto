<?php

namespace App\Models;

use App\Functions\Core;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

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
        'cost'
    ];

    protected $searchable = [
        'vehicle.name',
        'name',
        'details',
        'cost'
    ];

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle');
    }
}
