<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Appointment extends Model
{

    protected $fillable = [
        'user_id',
        'date',
        'time',
    ];



    public static function generateSlots(): array
    {
    $slots = [];
    $cursor = \Carbon\Carbon::parse('08:00');
    $end = \Carbon\Carbon::parse('23:00');

    while ($cursor < $end) {
        $slots[] = $cursor->format('H:i');
        $cursor->addMinutes(30);
    }

    return $slots;
    
    }

    public static function bookedTimesFor(string $date): array
{
    return self::where('date', $date)
        ->get()
        ->map(fn($appointment) => \Carbon\Carbon::parse($appointment->time)->format('H:i'))
        ->toArray();
}

 public static function availableSlotsFor(string $date): array
{
    $carbonDate = \Carbon\Carbon::parse($date);

    // Chiuso di domenica
    if ($carbonDate->isSunday()) {
        return [];
    }

    // Chiuso per ferie/festività (controllo nella tabella closed_days)
    $isClosed = \App\Models\ClosedDay::where('date', $date)->exists();
    if ($isClosed) {
        return [];
    }

    $slots = self::generateSlots();
    $booked = self::bookedTimesFor($date);

    if ($carbonDate->isToday()) {
        $now = \Carbon\Carbon::now()->format('H:i');
        $slots = array_filter($slots, fn($slot) => $slot > $now);
    }

    return array_values(array_diff($slots, $booked));
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
