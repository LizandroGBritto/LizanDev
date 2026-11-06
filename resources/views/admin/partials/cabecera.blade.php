<header class="border-b border-line bg-paper">
    <div class="mx-auto flex h-16 max-w-5xl items-center justify-between gap-3 px-4">
        <div class="flex items-center gap-6">
            <a href="{{ route('inicio') }}" class="flex items-center gap-2.5 font-display text-lg font-bold">
                <span class="grid h-[30px] w-[30px] place-items-center rounded-full bg-deep text-mint" aria-hidden="true">L</span>
                <span class="hidden sm:inline">LizanDev</span>
            </a>

            <nav class="flex gap-1 text-sm font-semibold" aria-label="{{ __('Admin panel') }}">
                <a href="{{ route('admin.resumen') }}" @if ($activo === 'resumen') aria-current="page" @endif
                    class="rounded-full px-3.5 py-1.5 text-muted hover:text-ink aria-[current=page]:bg-mint aria-[current=page]:text-deep">{{ __('Overview') }}</a>
                <a href="{{ route('admin.mensajes.index') }}" @if ($activo === 'mensajes') aria-current="page" @endif
                    class="rounded-full px-3.5 py-1.5 text-muted hover:text-ink aria-[current=page]:bg-mint aria-[current=page]:text-deep">{{ __('Messages') }}</a>
            </nav>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="rounded-full border-[1.5px] border-ink px-4 py-2 text-sm font-semibold transition-colors hover:bg-ink hover:text-white">
                {{ __('Sign out') }}
            </button>
        </form>
    </div>
</header>
