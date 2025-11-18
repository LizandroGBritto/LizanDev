<section id="contact" class="py-20 bg-slate-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                    ¡Trabajemos <span class="text-purple-600">Juntos!</span>
                </h2>
                <div class="w-24 h-1 bg-linear-to-r from-purple-500 to-pink-500 mx-auto rounded-full"></div>
                <p class="text-slate-600 mt-4">
                    ¿Tienes un proyecto en mente? Hablemos sobre cómo puedo ayudarte
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Contact Info -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Email</h3>
                        <a href="mailto:tu@email.com" class="text-purple-600 hover:text-purple-700">tu@email.com</a>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">Ubicación</h3>
                        <p class="text-slate-600">Tu Ciudad, País</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2">GitHub</h3>
                        <a href="https://github.com" target="_blank"
                            class="text-purple-600 hover:text-purple-700">@tuusuario</a>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="md:col-span-2">
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        @if (session()->has('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form wire:submit="submit" class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                                    Nombre completo
                                </label>
                                <input type="text" id="name" wire:model="name"
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition"
                                    placeholder="Tu nombre">
                                @error('name')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                    Email
                                </label>
                                <input type="email" id="email" wire:model="email"
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition"
                                    placeholder="tu@email.com">
                                @error('email')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-medium text-slate-700 mb-2">
                                    Mensaje
                                </label>
                                <textarea id="message" wire:model="message" rows="5"
                                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none transition resize-none"
                                    placeholder="Cuéntame sobre tu proyecto..."></textarea>
                                @error('message')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full px-8 py-4 bg-linear-to-r from-purple-500 to-pink-600 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300">
                                Enviar Mensaje
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>