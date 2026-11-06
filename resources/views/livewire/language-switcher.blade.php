<div class="language-switcher relative" data-language-switcher x-data="{ open: @entangle('isOpen') }">
    <button type="button" @click="open = !open" aria-haspopup="listbox" :aria-expanded="open"
        aria-label="{{ __('Language') }}"
        class="language-switcher__trigger group flex items-center gap-2 rounded-full px-3 py-2">
        <x-icon :name="'flag-' . $currentLocale" class="h-5 w-5" />
        <span class="text-sm font-medium">{{ strtoupper($currentLocale) }}</span>
        <x-icon name="chevron-down" class="h-4 w-4 transition-transform group-aria-expanded:rotate-180" />
    </button>

    <div x-show="open" x-cloak x-transition.opacity.duration.150ms @click.away="open = false" role="listbox"
        class="language-switcher__menu absolute top-full right-0 z-50 mt-2 w-40 overflow-hidden rounded-xl">
        @foreach (['es' => 'Español', 'en' => 'English'] as $locale => $label)
            <button type="button" wire:click="switchLocale('{{ $locale }}')" role="option"
                aria-selected="{{ $currentLocale === $locale ? 'true' : 'false' }}"
                class="language-switcher__option flex w-full items-center gap-3 px-4 py-3">
                <x-icon :name="'flag-' . $locale" class="h-5 w-5" />
                <span class="text-sm font-medium">{{ $label }}</span>
                @if ($currentLocale === $locale)
                    <x-icon name="check" class="ml-auto h-4 w-4 text-brand-700" />
                @endif
            </button>
        @endforeach
    </div>
</div>
