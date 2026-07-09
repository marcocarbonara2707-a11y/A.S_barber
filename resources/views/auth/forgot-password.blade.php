<x-layout>

<div class="auth-wrapper d-flex align-items-center justify-content-center py-5">
    <div class="app-card auth-card rounded-4 p-4 p-md-5" style="max-width:420px; width:100%;">

        <h2 class="text-center mb-1">Password dimenticata?</h2>
        <p class="text-center mb-4 footer-muted">
            Inserisci la tua email e ti invieremo un link per reimpostarla
        </p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full admin-input" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 py-2 mb-3">
                Invia link di reset
            </button>

            <div class="text-center">
                <a class="auth-link" href="{{ route('login') }}">Torna al login</a>
            </div>
        </form>
    </div>
</div>

</x-layout>
