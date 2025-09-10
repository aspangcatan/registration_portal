<?php

namespace App\Services;

use App\Models\Barangay;
use App\Models\CityMun;
use App\Models\Province;

class AddressService
{
    public function getProvinces()
    {
        return Province::orderBy('provDesc')->get(['provCode', 'provDesc']);
    }

    public function getCities($provCode)
    {
        return CityMun::where('provCode', $provCode)
            ->orderBy('citymunDesc')
            ->get(['citymunCode', 'citymunDesc']);
    }

    public function getBarangays($citymunCode)
    {
        return Barangay::where('citymunCode', $citymunCode)
            ->orderBy('brgyDesc')
            ->get(['brgyCode', 'brgyDesc']);
    }
}
