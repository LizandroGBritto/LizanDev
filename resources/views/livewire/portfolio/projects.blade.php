<section id="projects" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                    Proyectos <span class="text-purple-600">Destacados</span>
                </h2>
                <div class="w-24 h-1 bg-linear-to-r from-purple-500 to-pink-500 mx-auto rounded-full"></div>
                <p class="text-slate-600 mt-4 max-w-2xl mx-auto">
                    Una selección de proyectos en los que he trabajado recientemente
                </p>
            </div>

            <!-- Projects Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div
                        class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <!-- Project Image -->
                        <div class="relative h-48 overflow-hidden bg-slate-200">
                            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                loading="lazy">
                            <div
                                class="absolute inset-0 bg-linear-to-t from-slate-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>

                        <!-- Project Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-purple-600 transition-colors">
                                {{ $project['title'] }}
                            </h3>
                            <p class="text-slate-600 text-sm mb-4 line-clamp-3">
                                {{ $project['description'] }}
                            </p>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project['tags'] as $tag)
                                    <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-xs font-medium">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>

                            <!-- Links -->
                            <div class="flex gap-4 pt-4 border-t border-slate-100">
                                <a href="{{ $project['github'] }}"
                                    class="flex items-center gap-2 text-sm text-slate-600 hover:text-purple-600 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Código
                                </a>
                                <a href="{{ $project['demo'] }}"
                                    class="flex items-center gap-2 text-sm text-slate-600 hover:text-purple-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Demo
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Call to Action -->
            <div class="mt-12 text-center">
                <p class="text-slate-600 mb-4">¿Quieres ver más proyectos?</p>
                <a href="https://github.com" target="_blank"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-full hover:bg-purple-600 transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd" />
                    </svg>
                    Ver en GitHub
                </a>
            </div>
        </div>
    </div>
</section>