<?php

namespace App\Services;

use App\Models\PendingUser;

class PendingUserService
{
    public function create(array $data): PendingUser
    {
        return PendingUser::create([
            // Basic Info
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'] ?? null,
            'lastname' => $data['lastname'],
            'suffix' => $data['suffix'] ?? null,
            'email' => $data['email'],
            'birthdate' => $data['birthdate'],
            'blood_type' => $data['blood_type'],
            'mobile_no' => $data['mobile_no'],

            // Government IDs
            'tin' => $data['tin'],
            'gsis' => $data['gsis'],
            'philhealth' => $data['philhealth'],
            'pagibig' => $data['pagibig'],

            // Address
            'house_no' => $data['house_no'] ?? null,
            'street' => $data['street'] ?? null,
            'subdivision' => $data['subdivision'] ?? null,
            'province' => $data['province'],
            'city' => $data['city'],
            'barangay' => $data['barangay'],
            'zip_code' => $data['zip_code'] ?? null,

            // Emergency
            'emergency_contact_name' => $data['emergency_contact_name'],
            'emergency_contact_no' => $data['emergency_contact_no'],
            'emergency_contact_address' => $data['emergency_contact_address'],

            // Other Info
            'designation' => $data['designation'],
            'division' => $data['division'],
            'section' => $data['section'],
            'employee_no' => $data['employee_no'] ?? null, // keep optional if exists
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'status' => 'pending',
            'type' => $data['type'],
        ]);
    }
}
