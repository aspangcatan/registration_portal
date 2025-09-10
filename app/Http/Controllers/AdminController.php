<?php

namespace App\Http\Controllers;

use App\Models\PendingUser;
use App\Services\UserApprovalService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $approvalService;

    public function __construct(UserApprovalService $approvalService)
    {
        $this->approvalService = $approvalService;
    }

    public function index(Request $request)
    {
        $query = PendingUser::with(['designationRelation', 'divisionRelation', 'sectionRelation'])
            ->where('status', 'pending');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%");
            });
        }

        $pendingUsers = $query->paginate(10);

        return view('home', compact('pendingUsers'));
    }


    public function approve($id)
    {
        $pendingUser = PendingUser::findOrFail($id);

        try {
            $this->approvalService->approve($pendingUser);
            return redirect()->back()->with('success', 'User approved successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for duplicate entry error (SQLSTATE 23000)
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Cannot approve user: Username or email already exists.');
            }
            return redirect()->back()->with('error', 'Failed to approve user. Please try again.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to approve user. Please try again.');
        }
    }


    public function reject($id)
    {
        $user = PendingUser::findOrFail($id);
        try {
            $user->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'User rejected successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reject user. Please try again.');
        }
    }


}
