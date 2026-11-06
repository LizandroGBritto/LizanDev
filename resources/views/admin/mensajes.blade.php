@extends('layouts.admin')

@section('title', __('Contact requests'))

@section('body')
    @include('admin.partials.cabecera', ['activo' => 'mensajes'])

    <main class="mx-auto grid max-w-5xl gap-6 px-4 py-8">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <h1 class="text-3xl font-bold">{{ __('Contact requests') }}</h1>
                <p class="text-muted">{{ trans_choice('{0} No unread messages|{1} 1 unread message|[2,*] :count unread messages', $sinLeer, ['count' => $sinLeer]) }}</p>
            </div>

            <nav class="flex gap-2 text-sm" aria-label="{{ __('Filter') }}">
                <a href="{{ route('admin.mensajes.index') }}" @if (! $soloSinLeer) aria-current="page" @endif
                    class="rounded-full border border-line px-4 py-1.5 aria-[current=page]:border-deep aria-[current=page]:bg-deep aria-[current=page]:text-white">{{ __('All') }}</a>
                <a href="{{ route('admin.mensajes.index', ['filtro' => 'sin-leer']) }}" @if ($soloSinLeer) aria-current="page" @endif
                    class="rounded-full border border-line px-4 py-1.5 aria-[current=page]:border-deep aria-[current=page]:bg-deep aria-[current=page]:text-white">{{ __('Unread') }}</a>
            </nav>
        </div>

        @if (session('status'))
            <div role="status" class="rounded-lg border border-brand-600 bg-mint px-4 py-3 text-deep">{{ session('status') }}</div>
        @endif

        @forelse ($mensajes as $mensaje)
            <article @class(['rounded-xl border bg-card p-5', 'border-brand-600' => ! $mensaje->estaLeido(), 'border-line' => $mensaje->estaLeido()])>
                <header class="flex flex-wrap items-start justify-between gap-3">
                    <div class="min-w-0">
                        <h2 class="flex items-center gap-2 text-lg font-bold">
                            {{ $mensaje->nombre }}
                            @unless ($mensaje->estaLeido())
                                <span class="rounded-md bg-mint px-2 py-0.5 text-xs font-semibold text-deep">{{ __('New') }}</span>
                            @endunless
                        </h2>
                        <a href="mailto:{{ $mensaje->correo }}" class="break-all text-brand-700 underline underline-offset-4">{{ $mensaje->correo }}</a>
                    </div>
                    <time datetime="{{ $mensaje->created_at->toIso8601String() }}" class="text-sm text-muted">
                        {{ $mensaje->created_at->translatedFormat('j M Y, H:i') }}
                    </time>
                </header>

                <p class="mt-3 whitespace-pre-line text-ink">{{ $mensaje->mensaje }}</p>

                <footer class="mt-4 flex flex-wrap items-center justify-between gap-3 text-xs text-muted">
                    <span>
                        {{ strtoupper($mensaje->idioma ?? '—') }} · {{ $mensaje->ip ?? '—' }}
                        @if ($mensaje->puntaje_recaptcha !== null)
                            · reCAPTCHA {{ number_format($mensaje->puntaje_recaptcha, 1) }}
                        @endif
                    </span>

                    <div class="flex gap-2">
                        <form method="POST" action="{{ route('admin.mensajes.leido', $mensaje) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="rounded-full border border-line px-3.5 py-1.5 text-sm font-semibold text-ink transition-colors hover:border-deep">
                                {{ $mensaje->estaLeido() ? __('Mark as unread') : __('Mark as read') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.mensajes.destroy', $mensaje) }}"
                            data-confirm="{{ __('Delete this message? This cannot be undone.') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded-full border border-line px-3.5 py-1.5 text-sm font-semibold text-red-700 transition-colors hover:border-red-700">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </footer>
            </article>
        @empty
            <p class="rounded-xl border border-line bg-card p-8 text-center text-muted">{{ __('There are no messages yet.') }}</p>
        @endforelse

        <nav class="flex items-center justify-between text-sm" aria-label="{{ __('Pagination') }}">
            @if ($mensajes->previousPageUrl())
                <a href="{{ $mensajes->previousPageUrl() }}" rel="prev" class="rounded-full border border-line px-4 py-1.5 font-semibold hover:border-deep">&larr; {{ __('Previous') }}</a>
            @else
                <span></span>
            @endif
            <span class="text-muted">{{ $mensajes->currentPage() }} / {{ $mensajes->lastPage() }}</span>
            @if ($mensajes->nextPageUrl())
                <a href="{{ $mensajes->nextPageUrl() }}" rel="next" class="rounded-full border border-line px-4 py-1.5 font-semibold hover:border-deep">{{ __('Next') }} &rarr;</a>
            @else
                <span></span>
            @endif
        </nav>
    </main>
@endsection
