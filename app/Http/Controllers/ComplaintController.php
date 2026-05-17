<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // Show all complaints
    public function index()
    {
        $complaints = Complaint::orderBy('id', 'asc')->get();
        return view('index', compact('complaints'));
    }

    // Dashboard view 
    public function dashboard()
    {
        // Standard Laravel auth check
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['email' => 'Please log in first']);
        }

        $total     = Complaint::count();
        $pending   = Complaint::where('status', 'Pending')->count();
        $resolved  = Complaint::where('status', 'Resolved')->count();
        $complaints = Complaint::orderBy('id', 'asc')->get();

        return view('dashboard', compact('total', 'pending', 'resolved', 'complaints'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $complaint = Complaint::create([
            'name' => $request->name,
            'message' => $request->message,
            'status' => 'Pending',
        ]);

        DB::table('complaint_history')->insert([
            'complaint_id' => $complaint->id,
            'action'       => 'Created',
            'status'       => 'Pending',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()->route('complaints.index')->with('success', 'Complaint submitted!');
    }

    public function updateStatus($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->status = $complaint->status === 'Pending' ? 'Resolved' : 'Pending';
        $complaint->save();

        DB::table('complaint_history')->insert([
            'complaint_id' => $complaint->id,
            'action'       => 'Status Changed',
            'status'       => $complaint->status,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Status updated!');
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return redirect()->route('dashboard')->with('success', 'Complaint deleted!');
    }

    public function history()
    {
        $history = DB::table('complaint_history')->orderBy('created_at', 'desc')->get();
        return view('history', compact('history'));
    }
}