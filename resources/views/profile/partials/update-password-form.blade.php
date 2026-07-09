<section>
    <h5 class="app-card-title mb-2">Cambia password</h5>
    <p class="mb-3" style="color:#8B879E; font-size:14px;">
        Usa una password lunga e casuale per mantenere sicuro il tuo account.
    </p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <x-input-label for="update_password_current_password" :value="__('Password attuale')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full admin-input" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="update_password_password" :value="__('Nuova password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full admin-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="update_password_password_confirmation" :value="__('Conferma password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full admin-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary-custom">Salva</button>

            @if (session('status') === 'password-updated')
                <span class="text-success" style="font-size:14px;">Salvato.</span>
            @endif
        </div>
    </form>
</section>