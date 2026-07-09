<x-layout>

<div class="container py-5" style="max-width:500px;">
    <div class="app-card auth-card rounded-4 p-4 p-md-5">

        <h2 class="text-center mb-1">Aggiungi il tuo taglio</h2>
        <p class="text-center mb-4" style="color:#8B879E; font-size:14px;">
            Condividi il tuo taglio nella nostra galleria
        </p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('haircuts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label-custom">Nome del taglio</label>
                <input type="text" name="name" class="form-control admin-input" value="{{ old('name') }}" required maxlength="100" placeholder="Es. Fade classico">
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Descrizione (facoltativa)</label>
                <textarea name="description" class="form-control admin-input" rows="3" maxlength="255" placeholder="Racconta brevemente il taglio...">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Immagine</label>
                <input type="file" name="image" class="form-control admin-input" accept="image/*" required>
                <div style="font-size:12px; color:#8B879E; margin-top:6px;">Formati supportati: JPG, PNG. Max 4MB.</div>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 py-2">
                Invia per approvazione
            </button>
        </form>
    </div>
</div>

</x-layout>