<x-layout>

<div class="auth-wrapper d-flex align-items-center justify-content-center py-5">
    <div class="app-card auth-card rounded-4 p-4 p-md-5 text-center" style="max-width:460px; width:100%;">

        <h2 class="text-center mb-1">Verifica la tua email</h2>
        <p class="mb-4 footer-muted">
            Grazie per esserti registrato! Prima di iniziare, verifica il tuo indirizzo email cliccando sul link che ti abbiamo appena inviato. Se non hai ricevuto l'email, te ne invieremo volentieri un'altra.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 fw-semibold" style="color:#16a34a; font-size:14px;">
                Un nuovo link di verifica è stato inviato all'indirizzo email che hai fornito in fase di registrazione.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
            @csrf
            <button type="submit" class="btn btn-primary-custom w-100 py-2">
                Invia di nuovo l'email di verifica
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="auth-link border-0 bg-transparent p-0">Esci</button>
        </form>
    </div>
</div>

</x-layout>
