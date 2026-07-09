<section>
    <h5 class="app-card-title mb-2">Informazioni profilo</h5>
    <p class="mb-3" style="color:#8B879E; font-size:14px;">
        Aggiorna il tuo nome e la tua email.
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <x-input-label for="name" :value="__('Nome e Cognome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full admin-input" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full admin-input" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p style="font-size:13px; color:#8B879E;">
                        Il tuo indirizzo email non è verificato.
                        <button form="send-verification" class="auth-link" style="background:none; border:none; padding:0;">
                            Clicca qui per rinviare l'email di verifica.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success mt-2" style="font-size:13px;">
                            Un nuovo link di verifica è stato inviato al tuo indirizzo email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary-custom">Salva</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success" style="font-size:14px;">Salvato.</span>
            @endif
        </div>
    </form>
</section>