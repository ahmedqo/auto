<?php

namespace App\Models;

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

    public function Client()
    {
        return $this->belongsTo(Client::class, 'client');
    }
}
