<x-layout>

<div class="auth-wrapper d-flex align-items-center justify-content-center py-5">
    <div class="app-card auth-card rounded-4 p-4 p-md-5" style="max-width:420px; width:100%;">

        <h2 class="text-center mb-1">Bentornato</h2>
        <p class="text-center mb-4 footer-muted">Accedi al tuo account</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full admin-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full admin-input"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mb-3">
                <label for="remember_me" class="inline-flex items-center footer-muted">
                    <input id="remember_me" type="checkbox" class="me-2" name="remember">
                    Ricordami
                </label>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 py-2 mb-3">
                Accedi
            </button>

            @if (Route::has('password.request'))
                <div class="text-center mb-2">
                    <a class="auth-link" href="{{ route('password.request') }}">
                        Password dimenticata?
                    </a>
                </div>
            @endif

            <div class="text-center">
                <span class="footer-muted">Non hai un account?</span>
                <a class="auth-link ms-1" href="{{ route('register') }}">Registrati</a>
            </div>
        </form>
    </div>
</div>

</x-layout>