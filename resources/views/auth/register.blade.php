<x-layout>

<div class="auth-wrapper d-flex align-items-center justify-content-center py-5">
    <div class="app-card auth-card rounded-4 p-4 p-md-5" style="max-width:460px; width:100%;">

        <h2 class="text-center mb-1">Crea il tuo account</h2>
        <p class="text-center mb-4 footer-muted">Prenota il tuo appuntamento in pochi click</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <x-input-label for="name" :value="__('Nome e Cognome')" />
                <x-text-input id="name" class="block mt-1 w-full admin-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Es. Mario Rossi" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full admin-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-3">
                <x-input-label for="phone" :value="__('Numero di telefono')" />
                <x-text-input id="phone" class="block mt-1 w-full admin-input"
                                type="text"
                                name="phone"
                                :value="old('phone')"
                                required autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full admin-input"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Conferma Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full admin-input"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 py-2 mb-3">
                Registrati
            </button>

            <div class="text-center">
                <span class="footer-muted">Hai già un account?</span>
                <a class="auth-link ms-1" href="{{ route('login') }}">Accedi</a>
            </div>
        </form>
    </div>
</div>

</x-layout>