<x-layout>

<div class="auth-wrapper d-flex align-items-center justify-content-center py-5">
    <div class="app-card auth-card rounded-4 p-4 p-md-5" style="max-width:420px; width:100%;">

        <h2 class="text-center mb-1">Conferma password</h2>
        <p class="text-center mb-4 footer-muted">
            Questa è un'area protetta: conferma la password prima di continuare
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full admin-input" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 py-2">
                Conferma
            </button>
        </form>
    </div>
</div>

</x-layout>
