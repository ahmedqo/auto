<?php

namespace App\Models;

use App\Functions\Core;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    use HasFactory, HasSearch;

    protected $table = 'blacklist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client',
        'details',
        'company',
    ];

    protected $searchable = [
        'client.first_name',
        'client.last_name',
        'client.identity',
        'client.nationality',
        'client.license_number',
        'client.birth_date',
        'client.email',
        'client.phone',
        'client.address',

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

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client');
    }
}
