// Érvénytelen token/session esetén átirányítás bejelentkezésre
document.addEventListener('livewire:initialized', () => {
    // Livewire v3 esetén 'livewire:initialized' eseményre regisztrálunk
    Livewire.hook('message.failed', ({ response }) => {
        // Ellenőrizzük, hogy a hiba kódja 419 (CSRF Token lejárt)
        if (response && response.status === 419) {
            alert('A munkamenet lejárt. Kérjük, jelentkezzen be újra!');
            // Átirányítás a bejelentkezési oldalra
            window.location.href = '{{ route("login.index") }}';
            return false; // Megakadályozza a hiba továbbfutását
        }
    });
});
