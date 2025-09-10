<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $connection = 'hris';
    protected $table = 'addresses';

    protected $fillable = [
        'user_id',
        'house_no',
        'street',
        'subdivision_village',
        'province',
        'city',
        'barangay',
        'zip_code',
        'address_type'
    ];

    public $timestamps = false;
}
