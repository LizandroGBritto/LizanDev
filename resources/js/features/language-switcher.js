/** Livewire dispara `locale-changed` desde LanguageSwitcher::switchLocale(); se recarga para traducir todo. */
export function initLanguageSwitcher() {
    window.addEventListener('locale-changed', () => window.location.reload());
}
