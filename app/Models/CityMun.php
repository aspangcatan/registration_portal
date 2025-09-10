<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityMun extends Model
{
    protected $table = 'refcitymun';
    protected $primaryKey = 'citymunCode';
    public $incrementing = false;
    public $timestamps = false;
    protected $connection = 'address';


    protected $fillable = ['citymunCode', 'citymunDesc', 'provCode'];

    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'citymunCode', 'citymunCode');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provCode', 'provCode');
    }
}
