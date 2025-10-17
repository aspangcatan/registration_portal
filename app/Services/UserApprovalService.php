<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Employee;
use App\Models\PendingUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserApprovalService
{
    /**
     * Approve a pending user and insert into Users, Employees, and Addresses tables.
     */
    public function approve(PendingUser $pendingUser): void
    {
        // Wrap in transaction (safer)
        DB::transaction(function () use ($pendingUser) {

            // Create User
            $user = User::create([
                'fname' => $pendingUser->firstname,
                'mname' => $pendingUser->middlename,
                'lname' => $pendingUser->lastname,
                'suffix' => $pendingUser->suffix,
                'username' => $pendingUser->username,
                'designation' => $pendingUser->designation,
                'division' => $pendingUser->division,
                'section' => $pendingUser->section,
                'password' => $pendingUser->password,
            ]);

            // Create Employee
            $employee = Employee::create([
                'user_id' => $user->id,
                'email_address' => $pendingUser->email,
                'birthdate' => $pendingUser->birthdate,
                'blood_type' => $pendingUser->blood_type,
                'mobile_no' => $pendingUser->mobile_no,
                'tin_no' => $pendingUser->tin,
                'gsis_id_no' => $pendingUser->gsis,
                'philhealth_no' => $pendingUser->philhealth,
                'pagibig_id_no' => $pendingUser->pagibig,
                'emergency_name' => $pendingUser->emergency_contact_name,
                'emergency_contact' => $pendingUser->emergency_contact_no,
                'emergency_address' => $pendingUser->emergency_contact_address,
                'employee_no' => $pendingUser->employee_no,
                'employee_type' => $pendingUser->type,
            ]);

            // Create Address (linked to user)
            Address::create([
                'user_id' => $user->id, // ✅ added user_id
                'house_no' => $pendingUser->house_no,
                'street' => $pendingUser->street,
                'subdivision_village' => $pendingUser->subdivision,
                'province' => $pendingUser->province,
                'city' => $pendingUser->city,
                'barangay' => $pendingUser->barangay,
                'zip_code' => $pendingUser->zip_code,
                'address_type' => 'Residential', // default
            ]);

            // Update Pending User status
            $pendingUser->update(['status' => 'approved']);
        });
    }
}
