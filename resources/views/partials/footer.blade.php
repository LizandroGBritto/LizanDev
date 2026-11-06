<footer class="border-t border-line px-5 py-5 lg:px-12">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 text-xs text-muted sm:flex-row">
        <p>&copy; {{ $year }} LizanDev. {{ __('All rights reserved.') }}</p>

        <div class="flex items-center gap-4">
            <a href="{{ $socials['github'] }}" target="_blank" rel="noopener" aria-label="GitHub"
                class="transition-colors hover:text-ink">
                <x-icon name="github" class="h-5 w-5" />
            </a>
            <a href="{{ $socials['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"
                class="transition-colors hover:text-ink">
                <x-icon name="linkedin" class="h-5 w-5" />
            </a>
            <a href="mailto:{{ $socials['email'] }}" aria-label="Email" class="transition-colors hover:text-ink">
                <x-icon name="mail" class="h-5 w-5" />
            </a>
        </div>
    </div>
</footer>
