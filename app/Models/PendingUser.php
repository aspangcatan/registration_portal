<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'pending_users';

    protected $fillable = [
        // Basic Info
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'email',
        'birthdate',
        'blood_type',
        'mobile_no',

        // Government IDs
        'tin',
        'gsis',
        'philhealth',
        'pagibig',

        // Address
        'house_no',
        'street',
        'subdivision',
        'province',
        'city',
        'barangay',
        'zip_code',

        // Emergency Contact
        'emergency_contact_name',
        'emergency_contact_no',
        'emergency_contact_address',

        // Work Info
        'designation',
        'division',
        'section',
        'employee_no',

        // Account Info
        'username',
        'password',
        'status',
    ];


    protected $hidden = ['password'];

    public function designationRelation()
    {
        return $this->belongsTo(Designation::class, 'designation', 'id');
    }

    public function divisionRelation()
    {
        return $this->belongsTo(Division::class, 'division', 'id');
    }

    public function sectionRelation()
    {
        return $this->belongsTo(Section::class, 'section', 'id');
    }
}
