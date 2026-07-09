<x-layout>

<div class="container py-5">
    <h2 class="mb-3">Appuntamenti del {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}</h2>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex gap-2 mb-4 flex-wrap">
        <input type="date" name="date" class="form-control admin-input" style="max-width:200px;" value="{{ $selectedDate }}">
        <button type="submit" class="btn btn-primary-custom">Vai</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark-custom">Oggi</a>
    </form>

    <div class="app-card app-card-hover rounded-4 p-4 mb-4">
        <h5 class="app-card-title mb-3">Aggiungi un giorno di chiusura</h5>
        <form method="POST" action="{{ route('admin.closed-days.store') }}" class="row g-2 align-items-end">
            @csrf
            <div class="col-auto">
                <label class="form-label-custom">Data</label>
                <input type="date" name="date" class="form-control admin-input" required>
            </div>
            <div class="col-auto">
                <label class="form-label-custom">Motivo (facoltativo)</label>
                <input type="text" name="reason" class="form-control admin-input" placeholder="Es. Ferie">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary-custom">Chiudi questo giorno</button>
            </div>
        </form>
    </div>

    @if ($pendingHaircuts->isNotEmpty())
        <div class="app-card app-card-hover rounded-4 p-4 mb-4">
            <h5 class="app-card-title mb-3">Tagli in attesa di approvazione ({{ $pendingHaircuts->count() }})</h5>
            <div class="row g-3">
                @foreach ($pendingHaircuts as $haircut)
                    <div class="col-sm-6 col-md-4">
                        <div class="rounded-3 overflow-hidden" style="border:1px solid #24242e;">
                            <img src="{{ asset('storage/' . $haircut->image_path) }}" alt="{{ $haircut->name }}" style="width:100%; height:160px; object-fit:cover;">
                            <div class="p-3">
                                <div class="fw-semibold mb-1">{{ $haircut->name }}</div>
                                @if ($haircut->description)
                                    <div style="font-size:13px; color:#8B879E;" class="mb-2">{{ $haircut->description }}</div>
                                @endif
                                <div style="font-size:12px; color:#8B879E;" class="mb-2">Caricato da {{ $haircut->user->name }}</div>
                                <form method="POST" action="{{ route('admin.haircuts.approve', $haircut) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary-custom btn-sm w-100">Approva</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($appointments->isEmpty())
        <div class="empty-state text-center py-5 rounded-4">
            <p class="footer-muted mb-0">Nessun appuntamento prenotato per questo giorno.</p>
        </div>
    @else
        <div class="table-responsive app-card app-card-hover rounded-4 p-2">
            <table class="table admin-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Orario</th>
                        <th>Cliente</th>
                        <th>Telefono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td class="fw-semibold" style="color: var(--color-accent);">
                                {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}
                            </td>
                            <td>{{ $appointment->user->name }}</td>
                            <td>{{ $appointment->user->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>

</x-layout>