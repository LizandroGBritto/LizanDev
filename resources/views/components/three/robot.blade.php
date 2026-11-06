{{-- Robot decorativo hecho de cajas 3D. El anillo de tecnologías entra por el slot. --}}
<div class="bot-scene" data-tilt="10,22">
    <div class="bot-world">
        <div class="bot-shadow" aria-hidden="true"></div>

        <div class="bot-group bot-float" aria-hidden="true">
            <x-three.caja :w="130" :h="120" :d="84" color="var(--color-robot-body)" :y="44" />

            <div class="bot-led" style="--x:-34px;--y:18px;--lc:var(--color-led-amber)"></div>
            <div class="bot-led" style="--x:0px;--y:18px;--lc:var(--color-brand-300);--dl:.3s"></div>
            <div class="bot-led" style="--x:34px;--y:18px;--lc:var(--color-led-blue);--dl:.6s"></div>

            @foreach (['l', 'r'] as $side)
                <div class="bot-group bot-arm bot-arm--{{ $side }}">
                    <div class="bot-sway">
                        <x-three.caja :w="28" :h="90" :d="28" color="var(--color-brand-400)" :y="46" />
                    </div>
                </div>
            @endforeach

            <div class="bot-group bot-head">
                <x-three.caja :w="112" :h="92" :d="92" color="var(--color-brand-400)" />
                <x-three.caja :w="8" :h="28" :d="8" color="var(--color-brand-300)" :y="-60" />
                <x-three.caja :w="14" :h="14" :d="14" color="var(--color-amber)" :y="-78" />
                <x-three.caja :w="10" :h="34" :d="34" color="var(--color-robot-body)" :x="-61" />
                <x-three.caja :w="10" :h="34" :d="34" color="var(--color-robot-body)" :x="61" />
                <div class="bot-eye" style="--x:-24px"></div>
                <div class="bot-eye" style="--x:24px"></div>
                <div class="bot-mouth"></div>
            </div>

            <div class="bot-held">
                <div class="bot-held__chip" data-tech-held></div>
            </div>
        </div>

        {{ $slot }}
    </div>
</div>
