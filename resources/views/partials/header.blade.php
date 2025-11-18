<header class="header">
    <div class="container">
        <nav class="nav-container">
            <a href="{{ route('front.index') }}" class="logo-header">
                <img class="logo-header-img" src="{{ url('assets_front/images/grafitech_logo_blanco.png') }}"
                    alt="logo de Grafitec" height="71" decoding="async">
            </a>

            <div class="nav-menu-mobile">
                <button class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="has-submenu">
                    <button class="btn-languague">
                        <picture>
                            <source media="(min-width: 1024px)" srcset="{{ url('assets_front/images/pixel.png') }}">
                            <img title="{{ getLocaleName(currentLocale()) }}"
                                src="{{ url('assets_front/images/' . getLocaleFlag(currentLocale())) }}" width="16"
                                height="16" alt="bandera" loading="lazy" decoding="async">
                        </picture>
                        <picture>
                            <source media="(min-width: 1024px)" srcset="{{ url('assets_front/images/pixel.png') }}">
                            <img src="{{ url('assets_front/images/icons/caret-down.svg') }}" width="16" height="16"
                                alt="desplegar menu" loading="lazy" decoding="async">
                        </picture>
                    </button>
                    <ul class="submenu">
                        @foreach(['es', 'en', 'pt', 'de'] as $locale)
                            @if($locale !== currentLocale())
                                <li>
                                    <a href="{{ route('locale.change', $locale) }}" style="color: #000;">
                                        <picture>
                                            <source media="(min-width: 1024px)"
                                                srcset="{{ url('assets_front/images/pixel.png') }}">
                                            <img title="{{ getLocaleName($locale) }}"
                                                src="{{ url('assets_front/images/' . getLocaleFlag($locale)) }}" width="16"
                                                height="16" alt="bandera" loading="lazy" decoding="async">
                                        </picture>
                                        {{ getLocaleShort($locale) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="{{ route('front.index') }}">@lang('traduccionesFront.nav.home')</a></li>
                    <li><a href="{{ route('front.nosotros') }}">@lang('traduccionesFront.nav.we_are_grafitec')</a></li>
                    <li><a href="{{ route('front.responsabilidad_social') }}">@lang('traduccionesFront.nav.csr')</a>
                    </li>
                    <li><a
                            href="{{ route('front.contacto', ['asunto' => 'Solicitar Cotización']) }}">@lang('traduccionesFront.nav.request_quote')</a>
                    </li>
                    <li><a
                            href="{{ route('front.contacto', ['asunto' => 'Atención al Cliente']) }}">@lang('traduccionesFront.nav.contact')</a>
                    </li>
                    <li class="has-submenu has-submenu-deskotp">
                        <button class="btn-languague">
                            {{ getLocaleShort(currentLocale()) }}
                            <picture>
                                <source media="(max-width: 1023px)" srcset="{{ url('assets_front/images/pixel.png') }}">
                                <img src="{{ url('assets_front/images/' . getLocaleFlag(currentLocale())) }}" width="16"
                                    height="16" alt="bandera" loading="lazy" decoding="async">
                            </picture>
                            <picture>
                                <source media="(max-width: 1023px)" srcset="{{ url('assets_front/images/pixel.png') }}">
                                <img src="{{ url('assets_front/images/icons/caret-down.svg') }}" width="16" height="16"
                                    alt="desplegar menu" loading="lazy" decoding="async">
                            </picture>
                        </button>
                        <ul class="submenu">
                            @foreach(['es', 'en', 'pt', 'de'] as $locale)
                                @if($locale !== currentLocale())
                                    <li>
                                        <a href="{{ route('locale.change', $locale) }}" style="color: #000;">
                                            <picture>
                                                <source media="(max-width: 1023px)"
                                                    srcset="{{ url('assets_front/images/pixel.png') }}">
                                                <img src="{{ url('assets_front/images/' . getLocaleFlag($locale)) }}" width="16"
                                                    height="16" alt="bandera" loading="lazy" decoding="async">
                                            </picture>
                                            {{ getLocaleShort($locale) }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>