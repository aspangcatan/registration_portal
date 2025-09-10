<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $connection = 'hris';
    protected $table = 'employees';
    const CREATED_AT = 'date_created';   // ✅ custom created_at
    const UPDATED_AT = 'date_updated';   // ✅ custom updated_at

    protected $fillable = [
        'user_id',
        'email_address',
        'birthdate',
        'blood_type',
        'mobile_no',
        'tin_no',
        'gsis_id_no',
        'philhealth_no',
        'pagibig_id_no',
        'emergency_name',
        'emergency_contact',
        'emergency_address',
        'employee_no'
    ];
}
