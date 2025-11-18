<section id="about" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                    Sobre <span class="text-purple-600">Mí</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-pink-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Imagen/Ilustración -->
                <div class="relative">
                    <div
                        class="aspect-square rounded-2xl bg-gradient-to-br from-purple-100 to-pink-100 p-8 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-pink-500/10"></div>
                        <div class="relative z-10 flex items-center justify-center h-full">
                            <svg class="w-full h-full text-purple-600/20" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="space-y-6">
                    <p class="text-lg text-slate-600 leading-relaxed">
                        {{ $bio }}
                    </p>

                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-slate-900">¿Qué me apasiona?</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-slate-600">Crear soluciones innovadoras y escalables</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-slate-600">Aprender nuevas tecnologías constantemente</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-purple-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-slate-600">Colaborar en proyectos desafiantes</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Estadísticas -->
                    <div class="grid grid-cols-3 gap-4 pt-6">
                        @foreach($experience as $exp)
                            <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl">
                                <div class="text-3xl font-bold text-purple-600">{{ $exp['years'] }}</div>
                                <div class="text-sm text-slate-600 mt-1">{{ $exp['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>