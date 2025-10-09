<?php

namespace App\Http\Controllers;


use App\Services\AddressService;
use App\Services\PendingUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    protected $pendingUserService, $addressService;

    public function __construct(PendingUserService $pendingUserService, AddressService $addressService)
    {
        $this->pendingUserService = $pendingUserService;
        $this->addressService = $addressService;
    }

    public function storePendingUser(Request $request)
    {
        // Validate request and get only validated fields
        $validated = $request->validate([
            // Basic Information
            'firstname'   => 'required|string|max:255',
            'middlename'  => 'nullable|string|max:255',
            'lastname'    => 'required|string|max:255',
            'suffix'      => 'nullable|string|max:50',
            'email'       => 'required|string|email|max:255',
            'birthdate'   => 'required|date',
            'blood_type'  => 'required|string|max:3',
            'mobile_no'   => 'required|string|max:20',

            // Government IDs
            'tin'         => 'required|string|max:50',
            'gsis'        => 'required|string|max:50',
            'philhealth'  => 'required|string|max:50',
            'pagibig'     => 'required|string|max:50',

            // Address
            'house_no'    => 'nullable|string|max:50',
            'street'      => 'nullable|string|max:255',
            'subdivision' => 'nullable|string|max:255',
            'province'    => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'barangay'    => 'required|string|max:255',
            'zip_code'    => 'nullable|string|max:10',

            // Emergency
            'emergency_contact_name'    => 'required|string|max:255',
            'emergency_contact_no'      => 'required|string|max:20',
            'emergency_contact_address' => 'required|string|max:255',

            // Other Info
            'designation' => 'required|integer',
            'division'    => 'required|integer',
            'section'     => 'required|integer',
            'username'    => 'required|string|max:255',
            'password'    => 'required|string|min:6',
            'type'    => 'required|string',
        ]);

        // Check if username already exists in 'users' table
        $usernameExistsInUsers = \App\Models\User::where('username', $validated['username'])->exists();

        // Check if username already exists in 'pending_users' table
        $usernameExistsInPending = \App\Models\PendingUser::where('username', $validated['username'])->exists();

        if ($usernameExistsInUsers || $usernameExistsInPending) {
            return redirect()->back()->withInput()->withErrors([
                'username' => 'The username is already taken. Please choose another one.'
            ]);
        }

        $this->pendingUserService->create($validated);
        return redirect()->back()->with('success', 'Your registration is submitted and waiting for approval.');
    }


    public function getDropdownData(Request $request)
    {
        $designations = DB::table('tdh_user.designation')->select('id', 'description')->get();
        $divisions = DB::table('tdh_user.division')->select('id', 'description', 'code')->get();
        $sections = DB::table('tdh_user.section')->select('id', 'division', 'description', 'code')->get();

        return response()->json([
            'designations' => $designations,
            'divisions' => $divisions,
            'sections' => $sections,
        ]);
    }

    public function getProvinces()
    {
        return response()->json($this->addressService->getProvinces());
    }

    public function getCities($provCode)
    {
        return response()->json($this->addressService->getCities($provCode));
    }

    public function getBarangays($citymunCode)
    {
        return response()->json($this->addressService->getBarangays($citymunCode));
    }
}
