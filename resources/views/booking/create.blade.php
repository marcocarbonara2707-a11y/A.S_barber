<x-layout>

<div class="container py-4" style="max-width:600px;">

    <div class="d-flex align-items-center gap-3 mb-4">
        <button type="button" class="booking-back-btn" onclick="history.back()" aria-label="Torna indietro">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <h2 class="mb-0" style="font-family:var(--font-display); letter-spacing:1px; font-size:30px;">PRENOTA IL TAGLIO</h2>
    </div>

    <div class="step-label mb-3">01 · Scegli il giorno</div>

    <div class="d-flex align-items-center justify-content-between mb-2">
        <button type="button" id="prevMonthBtn" class="month-nav-btn" aria-label="Mese precedente">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <div id="monthLabel" style="font-size:15px; font-weight:600; color:var(--color-light); text-transform:capitalize;"></div>
        <button type="button" id="nextMonthBtn" class="month-nav-btn" aria-label="Mese successivo">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </button>
    </div>

    <div class="d-flex gap-2 overflow-auto pb-2 mb-4" id="dayPicker"></div>

    <input type="hidden" id="date">

    <div id="slotsWrapper" style="display:none;" class="mb-4">
        <div class="step-label mb-3">02 · Scegli l'orario</div>
        <div id="slots" class="slots-grid"></div>
    </div>

    <div id="confirmWrapper" style="display:none;">
        <div class="step-label mb-3">03 · Riepilogo</div>
        <div class="summary-card mb-3">
            <div class="summary-row">
                <span class="summary-label">Data</span>
                <span class="summary-value" id="summaryDate">—</span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Ora</span>
                <span class="summary-value" id="summaryTime">—</span>
            </div>
        </div>

        <div class="sticky-actions">
            <button id="confirmBtn" class="btn btn-primary-custom w-100 py-3" style="font-family:var(--font-display); font-size:22px; letter-spacing:1.5px;">Conferma appuntamento</button>
            <div id="errorMsg" class="text-danger mt-2 text-center"></div>
        </div>
    </div>

</div>

<script>
const dateInput = document.getElementById('date');
const slotsWrapper = document.getElementById('slotsWrapper');
const slotsDiv = document.getElementById('slots');
const confirmWrapper = document.getElementById('confirmWrapper');
const confirmBtn = document.getElementById('confirmBtn');
const errorMsg = document.getElementById('errorMsg');
const summaryDate = document.getElementById('summaryDate');
const summaryTime = document.getElementById('summaryTime');
let selectedTime = null;

function loadSlotsForDate(date) {
    slotsDiv.innerHTML = '';
    confirmWrapper.style.display = 'none';
    errorMsg.textContent = '';
    selectedTime = null;

    fetch(`/prenota/slots?date=${date}`)
        .then(res => res.json())
        .then(slots => {
            if (slots.length === 0) {
                slotsDiv.innerHTML = '<p class="footer-muted">Nessun orario disponibile per questo giorno.</p>';
            } else {
                slots.forEach(time => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'slot-btn';
                    btn.textContent = time;

                    btn.addEventListener('click', () => {
                        document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('slot-selected'));
                        btn.classList.add('slot-selected');

                        selectedTime = time;
                        summaryTime.textContent = time;
                        confirmWrapper.style.display = 'block';
                        errorMsg.textContent = '';
                    });

                    slotsDiv.appendChild(btn);
                });
            }
            slotsWrapper.style.display = 'block';
        });
}

const todayStr = "{{ \Carbon\Carbon::today()->format('Y-m-d') }}";
const todayDate = new Date(todayStr + 'T00:00:00');
let viewYear = todayDate.getFullYear();
let viewMonth = todayDate.getMonth();

const monthNames = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
const dayNames = ['Dom','Lun','Mar','Mer','Gio','Ven','Sab'];

const dayPicker = document.getElementById('dayPicker');
const monthLabel = document.getElementById('monthLabel');
const prevMonthBtn = document.getElementById('prevMonthBtn');
const nextMonthBtn = document.getElementById('nextMonthBtn');

function formatDate(y, m, d) {
    const mm = String(m + 1).padStart(2, '0');
    const dd = String(d).padStart(2, '0');
    return `${y}-${mm}-${dd}`;
}

function renderCalendar() {
    dayPicker.innerHTML = '';
    monthLabel.textContent = `${monthNames[viewMonth]} ${viewYear}`;

    const daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();

    for (let d = 1; d <= daysInMonth; d++) {
        const dateStr = formatDate(viewYear, viewMonth, d);
        const isPast = dateStr < todayStr;
        const weekday = new Date(viewYear, viewMonth, d).getDay();

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'day-card';
        btn.dataset.date = dateStr;
        btn.dataset.label = `${dayNames[weekday]} ${d}`;

        btn.innerHTML = `
            <span class="day-dow">${dayNames[weekday]}</span>
            <span class="day-number">${d}</span>
        `;

        if (isPast) {
            btn.disabled = true;
            btn.classList.add('day-disabled');
        } else {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.day-card').forEach(c => c.classList.remove('day-selected'));
                btn.classList.add('day-selected');

                dateInput.value = dateStr;
                summaryDate.textContent = btn.dataset.label;

                loadSlotsForDate(dateStr);
            });
        }

        dayPicker.appendChild(btn);
    }

    const isCurrentMonth = (viewYear === todayDate.getFullYear() && viewMonth === todayDate.getMonth());
    prevMonthBtn.disabled = isCurrentMonth;
    prevMonthBtn.style.opacity = isCurrentMonth ? '0.3' : '1';
}

prevMonthBtn.addEventListener('click', () => {
    viewMonth--;
    if (viewMonth < 0) { viewMonth = 11; viewYear--; }
    renderCalendar();
});

nextMonthBtn.addEventListener('click', () => {
    viewMonth++;
    if (viewMonth > 11) { viewMonth = 0; viewYear++; }
    renderCalendar();
});

renderCalendar();

confirmBtn.addEventListener('click', () => {
    errorMsg.textContent = '';

    fetch('{{ route("booking.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            date: dateInput.value,
            time: selectedTime
        })
    })
    .then(res => res.json().then(body => ({ status: res.status, body })))
    .then(({ status, body }) => {
        if (status === 200 && body.success) {
            window.location.href = body.wa_link;
        } else {
            errorMsg.textContent = body.error || 'Errore durante la prenotazione.';
        }
    });
});
</script>

</x-layout>