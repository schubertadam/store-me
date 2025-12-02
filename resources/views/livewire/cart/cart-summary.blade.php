<div class="offcanvas-footer flex-column text-center">

    {{-- Alösszeg --}}
    <div class="d-flex w-100 justify-content-between mb-2">
        <span>Termékek nettó ára:</span>
        <span class="h6 mb-0">{{ format_currency($subtotal) }}</span>
    </div>

    {{-- Szállítási díj (opcionális megjelenítés) --}}
    <div class="d-flex w-100 justify-content-between mb-4">
        <span>Szállítási díj:</span>
        <span class="h6 mb-0">{{ format_currency($shippingFee) }}</span>
    </div>

    {{-- VÉGÖSSZEG --}}
    <div class="d-flex w-100 justify-content-between mb-4">
        <span class="fw-bold">Végösszeg:</span>
        <span class="h4 mb-0 text-success">{{ format_currency($total) }}</span>
    </div>

    {{-- Checkout Gomb --}}
    <a href="#" class="btn btn-primary btn-icon btn-icon-start rounded w-100 mb-4">
        <i class="fas fa-credit-card fs-18"></i> Tovább a Pénztárhoz
    </a>

    {{-- Opcionális üzenet --}}
    <p class="fs-14 mb-0">Ingyenes szállítás {{ format_currency(50000) }} felett</p>
</div>
