<footer class="bg-ink text-white py-12 border-t border-line-dark">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto text-center">
            <p class="text-slate-400 mb-4">
                &copy; {{ $year }} LizanDev. Todos los derechos reservados.
            </p>
            <div class="flex justify-center gap-6">
                <a href="{{ $socials['github'] }}" target="_blank" rel="noopener" aria-label="GitHub"
                    class="text-slate-400 hover:text-white transition-colors">
                    <x-icon name="github" class="w-6 h-6" />
                </a>
                <a href="{{ $socials['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"
                    class="text-slate-400 hover:text-white transition-colors">
                    <x-icon name="linkedin" class="w-6 h-6" />
                </a>
                <a href="mailto:{{ $socials['email'] }}" aria-label="Email"
                    class="text-slate-400 hover:text-white transition-colors">
                    <x-icon name="mail" class="w-6 h-6" />
                </a>
            </div>
        </div>
    </div>
</footer>
