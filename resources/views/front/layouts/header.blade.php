<nav class="shadow-md overflow-hidden">
    <div class="container px-6 md:px-0 md:w-8/12 mx-auto">
        <div class="flex justify-between items-center h-[130px]">
            <div {{ app()->getLocale() == 'ar' ? 'data-aos=fade-left' : 'data-aos=fade-right' }}
                class="flex items-center gap-3">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(\App\Models\Setting::where('setting_key', 'logo')->first()->setting_value) }}"
                        alt="logo" class="w-36" />
                </a>
                <a href="{{ route('home') }}" class="hidden xl:block link">
                    {{ __('front.home') }}
                </a>
            </div>
            <div class="hidden xl:flex items-center gap-4"
                {{ app()->getLocale() == 'ar' ? 'data-aos=fade-right' : 'data-aos=fade-left' }}>
                <ul class="flex items-center gap-4">
                    <li><a href="{{ route('about.index') }}" class="link">{{ __('front.about_itihad') }}</a></li>
                    <li><a href="{{ route('join_us.show') }}" class="link">{{ __('front.join-us') }}</a></li>
                    <li><a href="{{ route('faq.index') }}" class="link">{{ __('front.faq') }}</a></li>
                    <li><a href="#contact-us" class="link">{{ __('front.contact-us') }}</a></li>
                </ul>
                <div class="flex items-center gap-4">
                    <a href="{{ route('dashboard.login.index') }}" class="btn btn-primary">{{ __('front.login') }}</a>
                    <a href="{{ route('dashboard.register') }}"
                        class="btn btn-secondary">{{ __('front.register') }}</a>
                    @if (getLocale() == 'en')
                        <a href="{{ route('lang.switchLang', 'ar') }}" style="font-family: Dinar, sans-serif"
                            class="text-sm w-20 h-8 md:text-base md:w-28 md:h-12 flex items-center justify-center rounded-xl font-normal transition duration-300 border border-primary text-secondary hover:bg-primary hover:text-white">
                            العربية
                        </a>
                    @else
                        <a href="{{ route('lang.switchLang', 'en') }}" style="font-family: 'Cairo', sans-serif;"
                            class="text-sm w-20 h-8 md:text-base md:w-28 md:h-12 flex items-center justify-center rounded-xl font-normal transition duration-300 border border-primary text-secondary hover:bg-primary hover:text-white">
                            English
                        </a>
                    @endif
                </div>
            </div>
            <button class="xl:hidden" id="menu_btn">
                <img src="{{ asset('assets/menu.png') }}" width="36" alt="Menu" id="menu_icon">
                <img src="{{ asset('assets/close.png') }}" width="36" alt="Close" id="close_icon"
                    class="hidden">
            </button>
        </div>
    </div>
</nav>

<!-- Mobile menu -->
<div id="menu_content"
    class="fixed top-0 right-0 w-full h-full bg-white z-50 transition-all duration-300 ease-in-out transform translate-x-full">

    <div class="container px-6 py-8">
        <button id="close_menu" class="absolute top-4 right-4">
            <img src="{{ asset('assets/close.png') }}" width="24" alt="">
        </button>
        <ul class="flex flex-col gap-4">
            <li><a href="{{ route('home') }}" class="link">{{ __('front.home') }}</a></li>
            <li><a href="{{ route('about.index') }}" class="link">{{ __('front.about_itihad') }}</a></li>
            <li><a href="{{ route('join_us.show') }}" class="link">{{ __('front.join-us') }}</a></li>
            <li><a href="{{ route('faq.index') }}" class="link">{{ __('front.faq') }}</a></li>
            <li><a href="#contact-us" class="link">{{ __('front.contact-us') }}</a></li>
            <li><a href="{{ route('dashboard.login.index') }}"
                    class="btn btn-primary w-full">{{ __('front.login') }}</a></li>
            <li><a href="{{ route('dashboard.register') }}"
                    class="btn btn-secondary w-full">{{ __('front.register') }}</a></li>
            <li>
                @if (getLocale() == 'en')
                    <a href="{{ route('lang.switchLang', 'ar') }}" style="font-family: Dinar, sans-serif"
                        class="text-sm w-full h-12 flex items-center justify-center rounded-xl font-normal transition duration-300 border border-primary text-secondary hover:bg-primary hover:text-white">
                        العربية
                    </a>
                @else
                    <a href="{{ route('lang.switchLang', 'en') }}" style="font-family: 'Cairo', sans-serif;"
                        class="text-sm w-full h-12 flex items-center justify-center rounded-xl font-normal transition duration-300 border border-primary text-secondary hover:bg-primary hover:text-white">
                        English
                    </a>
                @endif
            </li>
        </ul>
    </div>
</div>

@push('script')
    <script>
        const menu_btn = document.getElementById('menu_btn');
        const menu_content = document.getElementById('menu_content');
        const menu_icon = document.getElementById('menu_icon');
        const close_icon = document.getElementById('close_icon');

        let isMenuOpen = false;

        menu_btn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            toggleMenu();
        });

        function toggleMenu() {
            if (isMenuOpen) {
                menu_content.classList.remove('translate-x-full');
                menu_icon.classList.add('hidden');
                close_icon.classList.remove('hidden');
            } else {
                menu_content.classList.add('translate-x-full');
                menu_icon.classList.remove('hidden');
                close_icon.classList.add('hidden');
            }
        }
    </script>
@endpush
