<x-layout>

@php
    $isSunday = \Carbon\Carbon::now()->isSunday();
@endphp

<!-- HERO -->
<!-- HERO -->
<div class="hero-dark">
    <div class="hero-glow"></div>
    <div class="viewfinder-corner viewfinder-tl"></div>
    <div class="viewfinder-corner viewfinder-tr"></div>
    <div class="viewfinder-corner viewfinder-bl"></div>
    <div class="viewfinder-corner viewfinder-br"></div>
    <div class="hero-content">
        <div class="hero-badge">Street · Style · Cut</div>
        <div class="hero-title">A.S.<br>BARBER</div>
        <p class="hero-subtitle">Taglio, rasatura e stile. Prenoti in 30 secondi, salti la fila.</p>

        <a href="{{ auth()->check() ? route('booking.create') : route('register') }}" class="btn btn-primary-custom w-100 py-3 d-block" style="font-family:var(--font-display); font-size:24px; letter-spacing:1.5px;">
            PRENOTA ORA
        </a>

        <div class="hero-note">
            @if ($isSunday)
                Chiuso oggi, si riapre domani alle 8:00
            @else
                Aperto oggi dalle 8:00 alle 20:00
            @endif
        </div>
    </div>
</div>

<!-- GALLERIA -->
<div class="section-dark-alt">
    <div class="container">
        <div class="section-heading">GALLERIA</div>
        <div class="section-heading-bar"></div>

        @php
            $totalSlides = $haircuts->count() + 4;
        @endphp

        <div id="galleryCarousel" class="carousel slide gallery-carousel" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner">
                @foreach ($haircuts as $haircut)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <img src="{{ asset('storage/' . $haircut->image_path) }}" class="d-block w-100 gallery-img" alt="{{ $haircut->name }}">
                    </div>
                @endforeach

                @foreach (['foto1.jpg', 'foto2.jpg', 'foto3.jpg', 'foto4.jpg'] as $index => $file)
                    <div class="carousel-item @if ($haircuts->isEmpty() && $index === 0) active @endif">
                        <img src="{{ asset('images/gallery/' . $file) }}" class="d-block w-100 gallery-img" alt="A.S. Barber">
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

            <div class="carousel-indicators gallery-indicators">
                @for ($i = 0; $i < $totalSlides; $i++)
                    <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="{{ $i }}" @if ($i === 0) class="active" @endif></button>
                @endfor
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ auth()->check() ? route('haircuts.create') : route('login') }}" class="btn btn-outline-dark-custom px-4 py-2">
                Aggiungi il tuo taglio
            </a>
        </div>
    </div>
</div>

<!-- MANIFESTO -->
<div class="manifesto-section">
    <div class="container">
        <p class="manifesto-text">
            Non siamo ancora <span class="manifesto-fade">PER</span> tutti.<br>
            Ma lo <span class="manifesto-glow">saremo</span>.
        </p>
        <div class="manifesto-line"></div>
    </div>
</div>

<!-- COME FUNZIONA -->
<div class="section-dark">
    <div class="container">
        <div class="section-heading">COME FUNZIONA</div>
        <div class="section-heading-bar"></div>

        <div class="step-list-v2">
            <div class="step-card-v2">
                <span class="step-bignum">01</span>
                <div class="step-item-title">Registrati</div>
                <div class="step-item-text">Crea il tuo account in pochi secondi con nome, email e numero di telefono.</div>
            </div>
            <div class="step-card-v2">
                <span class="step-bignum">02</span>
                <div class="step-item-title">Scegli data e ora</div>
                <div class="step-item-text">Seleziona il giorno e l'orario che preferisci tra quelli disponibili.</div>
            </div>
            <div class="step-card-v2">
                <span class="step-bignum">03</span>
                <div class="step-item-title">Ricevi conferma su WhatsApp</div>
                <div class="step-item-text">Conferma l'appuntamento con un click, direttamente su WhatsApp.</div>
            </div>
        </div>
    </div>
</div>

<!-- ORARI -->
<div class="section-dark-alt">
    <div class="container">
        <div class="section-heading">ORARI DI APERTURA</div>
        <div class="section-heading-bar"></div>

        <div class="hours-card">
            <div class="hours-row">
                <span class="hours-day">Lunedì - Sabato</span>
                <span class="hours-time">8:00 - 22:00</span>
            </div>
            <div class="hours-row">
                <span class="hours-day">Domenica</span>
                <span class="hours-closed">Chiuso</span>
            </div>
        </div>
    </div>
</div>

</x-layout>