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

        $this->approvalService->approve($pendingUser);

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    public function reject($id)
    {
        $user = PendingUser::findOrFail($id);
        $user->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'User rejected successfully.');
    }

}
