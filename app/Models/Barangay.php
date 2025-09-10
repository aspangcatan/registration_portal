<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'refbrgy';
    protected $primaryKey = 'brgyCode';
    public $incrementing = false;
    public $timestamps = false;

    protected $connection = 'address';

    protected $fillable = ['brgyCode', 'brgyDesc', 'citymunCode', 'provCode'];
}
