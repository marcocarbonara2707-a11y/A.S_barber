<x-layout>

<div class="container py-5">
    <div class="dashboard-hero rounded-4 p-4 p-md-5 text-center">
        <h1 class="mb-2">Ciao, {{ explode(' ', auth()->user()->name)[0] }}</h1>
        <p class="mb-4" style="color:var(--color-badge-text);">
            Bentornato nella tua area personale
        </p>

        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
            <a href="{{ route('booking.create') }}" class="btn btn-primary-custom px-4 py-2">
                Prenota un appuntamento
            </a>
            <a href="{{ route('booking.my-appointments') }}" class="btn btn-outline-dark-custom px-4 py-2">
                I miei appuntamenti
            </a>
        </div>
    </div>
</div>

</x-layout>