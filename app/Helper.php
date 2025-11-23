<?php
function format_currency(float $amount, string $currencyCode = 'HUF', string $locale = 'hu_HU'): string
{
    if (!class_exists(NumberFormatter::class)) {
        // Fallback (ha hiányzik az Intl)
        return number_format($amount, 0, ',', '.') . ' ' . $currencyCode;
    }

    $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

    // === 1. A NULLA TIZEDESJEGYŰ PÉNZNEMEK FEHÉRLISTÁJA ===
    $zeroDecimalCurrencies = ['HUF']; // Magyar Forint, Japán Yen, Koreai Won, stb.

    // 2. Feltételesen állítjuk be a tizedesjegyek számát
    if (in_array(strtoupper($currencyCode), $zeroDecimalCurrencies)) {
        // HUF esetén 0 tizedesjegy:
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
    }

    // Formázás végrehajtása
    return $formatter->formatCurrency($amount, $currencyCode);
}
