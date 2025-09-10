<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'refprovince';
    protected $primaryKey = 'provCode';
    public $incrementing = false;
    public $timestamps = false;
    protected $connection = 'address';

    protected $fillable = ['provCode', 'provDesc', 'regCode'];

    public function cities()
    {
        return $this->hasMany(CityMun::class, 'provCode', 'provCode');
    }
}
