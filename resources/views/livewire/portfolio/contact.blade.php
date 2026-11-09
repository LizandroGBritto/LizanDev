<section id="contact" class="px-4 pb-10 lg:px-12 lg:pb-16">
    <div class="on-deep mx-auto grid max-w-7xl gap-8 rounded-[18px] bg-deep px-[22px] py-7 text-mint lg:grid-cols-[1fr_1.1fr] lg:gap-12 lg:px-12 lg:py-11">
        <div class="grid content-start gap-6">
            <div class="grid gap-1.5">
                <h2 class="text-[clamp(1.65rem,3.4vw,2.5rem)] leading-[1.04] font-bold text-white">
                    {{ __("Let's work together!") }}
                </h2>
                <p class="text-mint-soft">{{ __('Do you have a project in mind? Let us talk about how I can help you.') }}</p>
            </div>

            <ul class="grid gap-3">
                @foreach ($cards as $card)
                    <li class="flex items-center gap-3.5 rounded-xl border border-deep-line bg-deep-raised px-4 py-3.5">
                        <span class="grid h-10 w-10 flex-none place-items-center rounded-lg bg-amber text-amber-ink">
                            <x-icon :name="$card['icon']" class="h-5 w-5" />
                        </span>
                        <div class="min-w-0">
                            <h3 class="text-sm font-semibold text-white">{{ $card['title'] }}</h3>
                            @if ($card['href'])
                                <a href="{{ $card['href'] }}"
                                    @if (str_starts_with($card['href'], 'http')) target="_blank" rel="noopener" @endif
                                    class="break-all text-mint underline underline-offset-4 hover:text-white">{{ $card['text'] }}</a>
                            @else
                                <p class="text-mint">{{ $card['text'] }}</p>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="rounded-2xl bg-card p-6 text-ink lg:p-8">
            @if (session()->has('success'))
                <div role="status" class="mb-5 rounded-lg border border-brand-600 bg-mint px-4 py-3 text-deep">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit="submit" class="grid gap-5" data-contact-form
                @if ($recaptchaSiteKey) data-recaptcha-site-key="{{ $recaptchaSiteKey }}" @endif novalidate>
                <p class="text-sm text-muted">{{ __('Fields marked with * are required.') }}</p>

                <div>
                    <label for="nombre" class="mb-1.5 block text-sm font-medium">{{ __('Full name') }} <span class="text-red-700" aria-hidden="true">*</span></label>
                    <input type="text" id="nombre" wire:model="nombre" autocomplete="name" required maxlength="120"
                        @error('nombre') aria-invalid="true" aria-describedby="nombre-error" @enderror class="form-field" placeholder="{{ __('Your name') }}">
                    @error('nombre')
                        <span id="nombre-error" role="alert" class="mt-1 block text-sm text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="correo" class="mb-1.5 block text-sm font-medium">Email <span class="text-red-700" aria-hidden="true">*</span></label>
                    <input type="email" id="correo" wire:model="correo" autocomplete="email" required maxlength="190"
                        @error('correo') aria-invalid="true" aria-describedby="correo-error" @enderror class="form-field" placeholder="tu@email.com">
                    @error('correo')
                        <span id="correo-error" role="alert" class="mt-1 block text-sm text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="mensaje" class="mb-1.5 block text-sm font-medium">{{ __('Message') }} <span class="text-red-700" aria-hidden="true">*</span></label>
                    <textarea id="mensaje" wire:model="mensaje" rows="5" required maxlength="3000"
                        @error('mensaje') aria-invalid="true" aria-describedby="mensaje-error" @enderror class="form-field resize-none"
                        placeholder="{{ __('Tell me about your project...') }}"></textarea>
                    @error('mensaje')
                        <span id="mensaje-error" role="alert" class="mt-1 block text-sm text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Trampa para bots: fuera de pantalla y fuera del orden de tabulación --}}
                <div class="absolute -left-[9999px]" aria-hidden="true">
                    <label for="sitio_web">Website</label>
                    <input type="text" id="sitio_web" wire:model="sitioWeb" tabindex="-1" autocomplete="off">
                </div>

                <button type="submit"
                    class="rounded-full bg-deep px-8 py-3.5 font-semibold text-white transition-colors hover:bg-brand-800"
                    wire:loading.attr="disabled">
                    {{ __('Send Message') }}
                </button>

                @if ($recaptchaNotice)
                    <p class="text-xs text-muted">{{ $recaptchaNotice }}</p>
                @endif
            </form>
        </div>
    </div>
</section>
