@props(['photo' => null, 'name', 'role', 'skills' => []])

{{-- Carnet colgante: se inclina con el puntero y gira con un toque (features/carnet.js). --}}
<div class="carnet-lanyard">
    <div class="carnet-strap" aria-hidden="true"></div>

    <div class="carnet" data-tilt="14,22" data-flip role="button" tabindex="0" aria-pressed="false"
        aria-label="{{ __('Developer ID card. Tap to flip it.') }}">
        <div class="carnet__giro">
            <div class="carnet__cara">
                <div class="carnet__tope"><span>LIZANDEV · DEV ID</span><i class="carnet__ranura"></i></div>
                <div class="carnet__foto">
                    @if ($photo)
                        <img src="{{ $photo }}" alt="{{ $name }}" width="640" height="640" fetchpriority="high"
                            decoding="async">
                    @else
                        <x-icon name="user" class="w-1/2 h-1/2" />
                    @endif
                </div>
                <div class="carnet__datos">
                    <b class="carnet__nombre">{{ $name }}</b>
                    <span class="carnet__cargo">{{ $role }}</span>
                </div>
                <x-icon name="barcode" class="carnet__barras" />
            </div>

            <div class="carnet__cara carnet__cara--dorso">
                <div class="carnet__tope"><span>STACK</span><i class="carnet__ranura"></i></div>
                <div class="carnet__dorso">
                    <h3>{{ __('SKILLS') }}</h3>
                    <ul>
                        @foreach ($skills as [$tech, $kind])
                            <li>{{ $tech }}<em>{{ $kind }}</em></li>
                        @endforeach
                    </ul>
                    <x-icon name="qr" class="carnet__qr" />
                </div>
            </div>
        </div>
    </div>

    <p class="mt-2.5 text-center text-[11px] text-muted">{{ __('Tap the card to flip it') }}</p>
</div>
