<x-layout>

<div class="container py-4" style="max-width:600px;">

    <h2 class="mb-1" style="font-family:var(--font-display); letter-spacing:1px; font-size:34px;">I MIEI APPUNTAMENTI</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($appointments->isEmpty())

        <p class="appointments-subtitle mb-4">Nessuna prenotazione in programma</p>

        <div class="empty-state text-center py-5 px-4">
            <div class="empty-icon-box mb-4">
                <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="3"/><path d="M3 9h18M8 3v4M16 3v4"/></svg>
            </div>
            <div style="font-family:var(--font-display); font-size:26px; letter-spacing:1px;">ANCORA NULLA IN AGENDA</div>
            <p class="footer-muted mt-2 mb-4" style="max-width:280px; margin-left:auto; margin-right:auto;">
                Non hai appuntamenti in programma. Prenota il tuo posto e torna qui a controllarlo.
            </p>
            <a href="{{ route('booking.create') }}" class="btn btn-primary-custom px-4 py-2" style="font-family:var(--font-display); font-size:20px; letter-spacing:1px;">PRENOTA ORA</a>
        </div>

    @else

        <p class="appointments-subtitle mb-4">
            {{ $appointments->count() }} {{ $appointments->count() === 1 ? 'prenotazione' : 'prenotazioni' }} in programma
        </p>

        <div class="d-flex flex-column gap-3 mb-4">
            @foreach ($appointments as $appointment)
                @php
                    $date = \Carbon\Carbon::parse($appointment->date);
                @endphp
                <div class="{{ $loop->first ? 'appointment-highlight' : 'appointment-card' }} p-4">
                    @if ($loop->first)
                        <span class="badge-next mb-3 d-inline-block">Prossimo</span>
                    @endif

                    <div class="appointment-date">{{ Str::upper($date->translatedFormat('D j M')) }}</div>
                    <div class="appointment-time">ore <b>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</b></div>

                    <form method="POST" action="{{ route('booking.destroy', $appointment) }}" onsubmit="return confirm('Sei sicuro di voler cancellare questo appuntamento?');" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn {{ $loop->first ? 'btn-cancel-on-gradient' : 'btn-cancel-custom' }} w-100">Cancella appuntamento</button>
                    </form>
                </div>
            @endforeach
        </div>

        <a href="{{ route('booking.create') }}" class="btn btn-primary-custom w-100 py-3 d-block text-center" style="font-family:var(--font-display); font-size:22px; letter-spacing:1.5px;">+ NUOVA PRENOTAZIONE</a>

    @endif

</div>

</x-layout>
