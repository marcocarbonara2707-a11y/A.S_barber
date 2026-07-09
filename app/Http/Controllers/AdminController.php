<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
public function dashboard(Request $request)
{
    if (! auth()->user()->is_admin) {
        abort(403);
    }

    $request->validate(['date' => 'nullable|date_format:Y-m-d']);
    $selectedDate = $request->query('date', now()->format('Y-m-d'));

    $appointments = Appointment::where('date', $selectedDate)
        ->orderBy('time')
        ->get();

    $pendingHaircuts = \App\Models\Haircut::where('approved', false)
        ->orderBy('created_at')
        ->get();

    return view('admin.dashboard', compact('appointments', 'selectedDate', 'pendingHaircuts'));
}

    public function storeClosedDay(Request $request)
{
    if (! auth()->user()->is_admin) {
        abort(403);
    }

    $validated = $request->validate([
        'date' => 'required|date',
        'reason' => 'nullable|string|max:255',
    ]);

    \App\Models\ClosedDay::firstOrCreate(
        ['date' => $validated['date']],
        ['reason' => $validated['reason']]
    );

    return redirect()->route('admin.dashboard')->with('status', 'Giorno di chiusura aggiunto.');
}

    public function approveHaircut(\App\Models\Haircut $haircut)
{
    if (! auth()->user()->is_admin) {
        abort(403);
    }

    $haircut->update(['approved' => true]);

    return redirect()->route('admin.dashboard')->with('status', 'Taglio approvato e pubblicato nella galleria.');
}


}