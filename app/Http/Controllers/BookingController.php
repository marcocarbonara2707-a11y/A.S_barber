<?php

namespace App\Http\Controllers;
use App\Models\Appointment;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking.create');
    }

    public function availability(Request $request)
{
    $request->validate([
        'date' => 'required|date',
    ]);

    $slots = Appointment::availableSlotsFor($request->date);

    return response()->json($slots);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'date' => 'required|date',
        'time' => 'required',
    ]);

    $availableSlots = Appointment::availableSlotsFor($validated['date']);

    if (! in_array($validated['time'], $availableSlots)) {
        return response()->json([
            'error' => 'Questo orario non è più disponibile. Scegline un altro.'
        ], 422);
    }

    Appointment::create([
        'user_id' => auth()->id(),
        'date' => $validated['date'],
        'time' => $validated['time'],
    ]);

    $barberPhone = config('services.whatsapp.number');
    $clientName = auth()->user()->name;
    $formattedDate = \Carbon\Carbon::parse($validated['date'])->format('d/m/Y');

    $message = "Ciao! Vorrei confermare il mio appuntamento per il {$formattedDate} alle {$validated['time']}. Nome: {$clientName}";

    $waLink = "https://wa.me/{$barberPhone}?text=" . urlencode($message);

    return response()->json([
        'success' => true,
        'wa_link' => $waLink,
    ]);
}

    public function myAppointments()
{
    $appointments = Appointment::where('user_id', auth()->id())
        ->where('date', '>=', now()->format('Y-m-d'))
        ->orderBy('date')
        ->orderBy('time')
        ->get();

    return view('booking.my-appointments', compact('appointments'));
}

public function destroy(Appointment $appointment)
{
    if ($appointment->user_id !== auth()->id()) {
        abort(403);
    }

    $appointment->delete();

    return redirect()->route('booking.my-appointments')->with('status', 'Appuntamento cancellato con successo.');
}

}