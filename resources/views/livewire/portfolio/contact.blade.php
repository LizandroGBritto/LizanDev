<section id="contact" class="py-24 bg-paper">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-16 max-w-2xl">
                <h2 class="text-4xl md:text-5xl font-semibold text-slate-900 mb-4">
                    ¡Trabajemos <span class="text-brand-700">Juntos!</span>
                </h2>
                <p class="text-slate-600 text-lg">
                    ¿Tienes un proyecto en mente? Hablemos sobre cómo puedo ayudarte
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="md:col-span-1 space-y-4">
                    @foreach ($cards as $card)
                        <div class="bg-white border border-line p-6 rounded-xl">
                            <div class="w-11 h-11 bg-emerald-50 rounded-lg flex items-center justify-center mb-4">
                                <x-icon :name="$card['icon']" class="w-5 h-5 text-brand-700" />
                            </div>
                            <h3 class="font-semibold text-slate-900 mb-1">{{ $card['title'] }}</h3>
                            @if ($card['href'])
                                <a href="{{ $card['href'] }}"
                                    @if (str_starts_with($card['href'], 'http')) target="_blank" rel="noopener" @endif
                                    class="text-brand-700 hover:text-emerald-900 underline underline-offset-4 break-all">{{ $card['text'] }}</a>
                            @else
                                <p class="text-slate-600">{{ $card['text'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="md:col-span-2">
                    <div class="bg-white border border-line p-8 rounded-xl">
                        @if (session()->has('success'))
                            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form wire:submit="submit" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                                    Nombre completo
                                </label>
                                <input type="text" id="name" wire:model="name"
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-brand-700 focus:ring-2 focus:ring-emerald-100 outline-none transition-colors"
                                    placeholder="Tu nombre">
                                @error('name')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                    Email
                                </label>
                                <input type="email" id="email" wire:model="email"
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-brand-700 focus:ring-2 focus:ring-emerald-100 outline-none transition-colors"
                                    placeholder="tu@email.com">
                                @error('email')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-slate-700 mb-2">
                                    Mensaje
                                </label>
                                <textarea id="message" wire:model="message" rows="5"
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-brand-700 focus:ring-2 focus:ring-emerald-100 outline-none transition-colors resize-none"
                                    placeholder="Cuéntame sobre tu proyecto..."></textarea>
                                @error('message')
                                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full px-8 py-3.5 bg-brand-700 hover:bg-emerald-800 text-white rounded-lg font-semibold transition-colors">
                                Enviar Mensaje
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
