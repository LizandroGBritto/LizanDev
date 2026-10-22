@props(['slides', 'reverse' => false])

<div @class(['relative h-full min-h-[260px] md:min-h-[520px] overflow-hidden bg-slate-100', 'md:order-first' => $reverse])>
    <div {{ $attributes->class(['relative w-full h-full min-h-[inherit]']) }} data-carousel>
        @foreach ($slides as $slide)
            <div @class(['carousel-slide cursor-zoom-in group/img', 'active' => $loop->first]) data-carousel-slide
                data-modal-src="{{ $slide['src'] }}" data-modal-caption="{{ $slide['caption'] }}">
                <img src="{{ $slide['src'] }}" alt="{{ $slide['caption'] }}"
                    @unless ($loop->first) loading="lazy" @endunless decoding="async"
                    class="w-full h-full object-cover">
                <p
                    class="absolute bottom-4 left-4 bg-ink text-white px-3 py-1.5 rounded-md text-sm font-medium opacity-0 group-hover/img:opacity-100 transition-opacity duration-150">
                    {{ $slide['caption'] }}</p>
            </div>
        @endforeach

        <button type="button" class="carousel-btn carousel-prev" data-carousel-prev
            aria-label="{{ __('Previous slide') }}">
            <x-icon name="chevron-left" class="w-5 h-5" />
        </button>
        <button type="button" class="carousel-btn carousel-next" data-carousel-next
            aria-label="{{ __('Next slide') }}">
            <x-icon name="chevron-right" class="w-5 h-5" />
        </button>

        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2">
            @foreach ($slides as $slide)
                <button type="button" @class(['carousel-indicator', 'active' => $loop->first]) data-carousel-go="{{ $loop->index }}"
                    aria-label="{{ $slide['caption'] }}"></button>
            @endforeach
        </div>
    </div>
</div>
