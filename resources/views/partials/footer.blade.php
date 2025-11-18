<footer class="footer">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-column">
                <div class="footer-wrapper">
                    <a href="{{ route('front.index') }}">
                        <img class="footer-logo" src="{{ url('assets_front/images/logo_grafitec.png') }}"
                            alt="Grafitec logo" height="70" loading="lazy" decoding="async">
                    </a>
                    <p class="footer-description">
                        @lang('traduccionesFront.footer.company_description')
                    </p>

                    <ul class="footer-social">
                        @if($contactoInfo->facebook)
                            <li>
                                <a href="{{ $contactoInfo->facebook }}" target="_blank" rel="noopener noreferrer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22 12C22 6.48 17.52 2 12 2C6.48 2 2 6.48 2 12C2 16.84 5.44 20.87 10 21.8V15H8V12H10V9.5C10 7.57 11.57 6 13.5 6H16V9H14C13.45 9 13 9.45 13 10V12H16V15H13V21.95C18.05 21.45 22 17.19 22 12Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </li>
                        @endif
                        @if($contactoInfo->instagram)
                            <li>
                                <a href="{{ $contactoInfo->instagram }}" target="_blank" rel="noopener noreferrer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 12C15 12.5933 14.8241 13.1734 14.4944 13.6667C14.1648 14.1601 13.6962 14.5446 13.1481 14.7716C12.5999 14.9987 11.9967 15.0581 11.4147 14.9424C10.8328 14.8266 10.2982 14.5409 9.87868 14.1213C9.45912 13.7018 9.1734 13.1672 9.05764 12.5853C8.94189 12.0033 9.0013 11.4001 9.22836 10.8519C9.45542 10.3038 9.83994 9.83524 10.3333 9.50559C10.8266 9.17595 11.4067 9 12 9C12.7949 9.00247 13.5565 9.31934 14.1186 9.88141C14.6807 10.4435 14.9975 11.2051 15 12ZM21.375 7.875V16.125C21.375 17.5174 20.8219 18.8527 19.8373 19.8373C18.8527 20.8219 17.5174 21.375 16.125 21.375H7.875C6.48261 21.375 5.14726 20.8219 4.16269 19.8373C3.17812 18.8527 2.625 17.5174 2.625 16.125V7.875C2.625 6.48261 3.17812 5.14726 4.16269 4.16269C5.14726 3.17812 6.48261 2.625 7.875 2.625H16.125C17.5174 2.625 18.8527 3.17812 19.8373 4.16269C20.8219 5.14726 21.375 6.48261 21.375 7.875ZM16.5 12C16.5 11.11 16.2361 10.24 15.7416 9.49993C15.2471 8.75991 14.5443 8.18314 13.7221 7.84254C12.8998 7.50195 11.995 7.41283 11.1221 7.58647C10.2492 7.7601 9.44736 8.18868 8.81802 8.81802C8.18868 9.44736 7.7601 10.2492 7.58647 11.1221C7.41283 11.995 7.50195 12.8998 7.84254 13.7221C8.18314 14.5443 8.75991 15.2471 9.49993 15.7416C10.24 16.2361 11.11 16.5 12 16.5C13.1935 16.5 14.3381 16.0259 15.182 15.182C16.0259 14.3381 16.5 13.1935 16.5 12ZM18 7.125C18 6.9025 17.934 6.68499 17.8104 6.49998C17.6868 6.31498 17.5111 6.17078 17.3055 6.08564C17.1 6.00049 16.8738 5.97821 16.6555 6.02162C16.4373 6.06502 16.2368 6.17217 16.0795 6.3295C15.9222 6.48684 15.815 6.68729 15.7716 6.90552C15.7282 7.12375 15.7505 7.34995 15.8356 7.55552C15.9208 7.76109 16.065 7.93679 16.25 8.0604C16.435 8.18402 16.6525 8.25 16.875 8.25C17.1734 8.25 17.4595 8.13147 17.6705 7.9205C17.8815 7.70952 18 7.42337 18 7.125Z"
                                            fill="black" />
                                        <path
                                            d="M15 12C15 12.5933 14.8241 13.1734 14.4944 13.6667C14.1648 14.1601 13.6962 14.5446 13.1481 14.7716C12.5999 14.9987 11.9967 15.0581 11.4147 14.9424C10.8328 14.8266 10.2982 14.5409 9.87868 14.1213C9.45912 13.7018 9.1734 13.1672 9.05764 12.5853C8.94189 12.0033 9.0013 11.4001 9.22836 10.8519C9.45542 10.3038 9.83994 9.83524 10.3333 9.50559C10.8266 9.17595 11.4067 9 12 9C12.7949 9.00247 13.5565 9.31934 14.1186 9.88141C14.6807 10.4435 14.9975 11.2051 15 12ZM21.375 7.875V16.125C21.375 17.5174 20.8219 18.8527 19.8373 19.8373C18.8527 20.8219 17.5174 21.375 16.125 21.375H7.875C6.48261 21.375 5.14726 20.8219 4.16269 19.8373C3.17812 18.8527 2.625 17.5174 2.625 16.125V7.875C2.625 6.48261 3.17812 5.14726 4.16269 4.16269C5.14726 3.17812 6.48261 2.625 7.875 2.625H16.125C17.5174 2.625 18.8527 3.17812 19.8373 4.16269C20.8219 5.14726 21.375 6.48261 21.375 7.875ZM16.5 12C16.5 11.11 16.2361 10.24 15.7416 9.49993C15.2471 8.75991 14.5443 8.18314 13.7221 7.84254C12.8998 7.50195 11.995 7.41283 11.1221 7.58647C10.2492 7.7601 9.44736 8.18868 8.81802 8.81802C8.18868 9.44736 7.7601 10.2492 7.58647 11.1221C7.41283 11.995 7.50195 12.8998 7.84254 13.7221C8.18314 14.5443 8.75991 15.2471 9.49993 15.7416C10.24 16.2361 11.11 16.5 12 16.5C13.1935 16.5 14.3381 16.0259 15.182 15.182C16.0259 14.3381 16.5 13.1935 16.5 12ZM18 7.125C18 6.9025 17.934 6.68499 17.8104 6.49998C17.6868 6.31498 17.5111 6.17078 17.3055 6.08564C17.1 6.00049 16.8738 5.97821 16.6555 6.02162C16.4373 6.06502 16.2368 6.17217 16.0795 6.3295C15.9222 6.48684 15.815 6.68729 15.7716 6.90552C15.7282 7.12375 15.7505 7.34995 15.8356 7.55552C15.9208 7.76109 16.065 7.93679 16.25 8.0604C16.435 8.18402 16.6525 8.25 16.875 8.25C17.1734 8.25 17.4595 8.13147 17.6705 7.9205C17.8815 7.70952 18 7.42337 18 7.125Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </li>
                        @endif
                        @if($contactoInfo->linkedin)
                            <li>
                                <a href="{{ $contactoInfo->linkedin }}" target="_blank" rel="noopener noreferrer">
                                    <svg width="22" height="22" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.0002 0.0545044C4.50737 0.0545044 0.0546875 4.50719 0.0546875 10C0.0546875 15.4928 4.50737 19.9455 10.0002 19.9455C15.493 19.9455 19.9457 15.4928 19.9457 10C19.9457 4.50719 15.493 0.0545044 10.0002 0.0545044ZM7.56562 14.1222H5.55165V7.64106H7.56562V14.1222ZM6.5462 6.84542C5.9101 6.84542 5.49882 6.39476 5.49882 5.8374C5.49882 5.26864 5.92254 4.83146 6.5721 4.83146C7.22167 4.83146 7.61949 5.26864 7.63192 5.8374C7.63192 6.39476 7.22167 6.84542 6.5462 6.84542ZM14.9211 14.1222H12.9072V10.5304C12.9072 9.69439 12.615 9.12667 11.8867 9.12667C11.3304 9.12667 10.9999 9.51102 10.8539 9.88087C10.8 10.0124 10.7865 10.1989 10.7865 10.3844V14.1212H8.77151V9.70786C8.77151 8.89875 8.74561 8.22225 8.71867 7.64003H10.4685L10.5607 8.5403H10.6011C10.8663 8.11762 11.5158 7.49395 12.6026 7.49395C13.9276 7.49395 14.9211 8.38179 14.9211 10.2901V14.1222Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <p class="footer-description">
                        @lang('traduccionesFront.footer.quality_commitment')
                    </p>
                </div>
            </div>

            <div class="footer-column">
                <div class="footer-info">
                    <h3 class="footer-title">@lang('traduccionesFront.nav.about_us')</h3>
                    <ul class="footer-links">
                        <li>
                            <a href="{{ route('front.index') }}">
                                @lang('traduccionesFront.nav.home')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.nosotros') }}">
                                @lang('traduccionesFront.nav.we_are_grafitec')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.nosotros') }}#certification">
                                @lang('traduccionesFront.nav.certifications')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.index') }}#tecnologias">
                                @lang('traduccionesFront.nav.our_technology')
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-column">
                <div class="footer-info">
                    <h3 class="footer-title">@lang('traduccionesFront.nav.csr')</h3>
                    <ul class="footer-links">
                        <li><a
                                href="{{ route('front.nosotros') }}#quality">@lang('traduccionesFront.nav.quality_policy')</a>
                        </li>
                        <li><a
                                href="{{ route('front.salud_seguridad') }}">@lang('traduccionesFront.nav.occupational_health')</a>
                        </li>
                        <li><a
                                href="{{ route('front.responsabilidad_social') }}">@lang('traduccionesFront.nav.social_responsibility')</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-column">
                <div class="footer-info">
                    <h3 class="footer-title">@lang('traduccionesFront.nav.contact')</h3>
                    <ul class="footer-links">
                        <li><a
                                href="{{ route('front.contacto', ['asunto' => 'Solicitar Cotización']) }}">@lang('traduccionesFront.nav.request_quote')</a>
                        </li>
                        <li><a
                                href="{{ route('front.contacto', ['asunto' => 'Trabaja con Nosotros']) }}">@lang('traduccionesFront.nav.work_with_us')</a>
                        </li>
                        <li><a
                                href="{{ route('front.contacto', ['asunto' => 'Atención al Cliente']) }}">@lang('traduccionesFront.nav.contact_us')</a>
                        </li>
                    </ul>
                    <img class="footer-iso" src="{{ url('assets_front/images/iso9001 2.png') }}" alt="iso logo"
                        height="107" width="107" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
        <div class="container-porta">
            <p class="text-footer">@lang('traduccionesFront.footer.all_rights_reserved')</p>
            <p class="text-footer">
                @lang('traduccionesFront.footer.developed_by')
            </p>
        </div>
    </div>
</footer>