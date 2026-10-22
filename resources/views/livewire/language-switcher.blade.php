<div class="language-switcher fixed top-4 right-4 z-50" data-language-switcher x-data="{ open: @entangle('isOpen') }">
    <div class="relative">
        <button type="button" @click="open = !open" aria-haspopup="listbox" :aria-expanded="open"
            class="group flex items-center gap-2 px-3 py-2 bg-ink border border-line-dark text-white rounded-md hover:border-brand-500 transition-colors">
            <x-icon :name="'flag-' . $currentLocale" class="w-5 h-5" />
            <span class="text-sm font-medium">{{ strtoupper($currentLocale) }}</span>
            <x-icon name="chevron-down" class="w-4 h-4 transition-transform group-aria-expanded:rotate-180" />
        </button>

        <div x-show="open" x-transition.opacity.duration.150ms @click.away="open = false" role="listbox"
            class="absolute top-full right-0 mt-2 w-40 bg-ink-raised border border-line-dark rounded-md overflow-hidden">
            @foreach (['es' => 'Español', 'en' => 'English'] as $locale => $label)
                <button type="button" wire:click="switchLocale('{{ $locale }}')" role="option"
                    aria-selected="{{ $currentLocale === $locale ? 'true' : 'false' }}" @class([
                        'w-full flex items-center gap-3 px-4 py-3 text-white hover:bg-ink transition-colors',
                        'bg-ink' => $currentLocale === $locale,
                    ])>
                    <x-icon :name="'flag-' . $locale" class="w-5 h-5" />
                    <span class="text-sm font-medium">{{ $label }}</span>
                    @if ($currentLocale === $locale)
                        <x-icon name="check" class="w-4 h-4 ml-auto text-brand-400" />
                    @endif
                </button>
            @endforeach
        </div>
    </div>
</div>
