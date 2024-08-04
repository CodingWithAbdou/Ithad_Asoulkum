<nav class="shadow-md overflow-hidden">
    <div class="container px-4 md:px-6 lg:w-10/12 xl:w-8/12 mx-auto">
        <div class="flex justify-between items-center h-24"> <!-- Increased height to h-24 -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(\App\Models\Setting::where('setting_key', 'logo')->first()->setting_value) }}"
                        alt="logo" class="w-36" />
                </a>
            </div>
            <div class="hidden xl:flex items-center space-x-6"> <!-- Increased space-x-6 for more space between items -->
                <a href="{{ route('home') }}" class="nav-link">{{ __('front.home') }}</a>
                <a href="{{ route('about.index') }}" class="nav-link">{{ __('front.about_itihad') }}</a>
                <a href="{{ route('join_us.show') }}" class="nav-link">{{ __('front.join-us') }}</a>
                <a href="{{ route('faq.index') }}" class="nav-link">{{ __('front.faq') }}</a>
                <a href="#contact-us" class="nav-link">{{ __('front.contact-us') }}</a>
                <div class="flex items-center space-x-3"> <!-- Added a div with space-x-3 for login and register -->
                    <a href="{{ route('dashboard.login.index') }}" class="btn btn-primary">{{ __('front.login') }}</a>
                    <a href="{{ route('dashboard.register') }}"
                        class="btn btn-secondary">{{ __('front.register') }}</a>
                </div>
                <a href="{{ route('lang.switchLang', getLocale() == 'en' ? 'ar' : 'en') }}" class="lang-switch-btn">
                    {{ getLocale() == 'en' ? 'العربية' : 'English' }}
                </a>
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
    class="fixed top-0 left-0 w-full h-full bg-white z-50 transition-all duration-300 ease-in-out transform translate-x-full hidden xl:hidden">
    <div class="container px-6 py-8">
        <button id="close_menu" class="absolute top-4 right-4">
            <img src="{{ asset('assets/close.png') }}" width="24" alt="">
        </button>
        <ul class="flex flex-col gap-4">
            <li><a href="{{ route('home') }}" class="nav-link">{{ __('front.home') }}</a></li>
            <li><a href="{{ route('about.index') }}" class="nav-link">{{ __('front.about_itihad') }}</a></li>
            <li><a href="{{ route('join_us.show') }}" class="nav-link">{{ __('front.join-us') }}</a></li>
            <li><a href="{{ route('faq.index') }}" class="nav-link">{{ __('front.faq') }}</a></li>
            <li><a href="#contact-us" class="nav-link">{{ __('front.contact-us') }}</a></li>
            <li class="ml-4">
                <a href="{{ route('dashboard.login.index') }}"
                    class="bg-green-500 text-white py-2 px-4 rounded w-full block text-center">
                    {{ __('front.login') }}
                </a>
            </li>
            <li class="ml-4">
                <a href="{{ route('dashboard.register') }}"
                    class="bg-gray-500 text-white py-2 px-4 rounded w-full block text-center">
                    {{ __('front.register') }}
                </a>
            </li>
            <li>
                <a href="{{ route('lang.switchLang', getLocale() == 'en' ? 'ar' : 'en') }}"
                    class="lang-switch-btn w-full">
                    {{ getLocale() == 'en' ? 'العربية' : 'English' }}
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    .nav-link {
        position: relative;
        color: #333;
        transition: color 0.3s;
        padding: 0.5rem 0.75rem;
        font-weight: 500;
        /* Added for better visibility */
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        bottom: -4px;
        left: 0;
        background-color: #007bff;
        transform: scaleX(0);
        transition: transform 0.3s;
    }

    .nav-link:hover::after {
        transform: scaleX(1);
    }

    .btn {
        transition: all 0.3s;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .lang-switch-btn {
        font-family: 'Cairo', sans-serif;
        font-size: 0.875rem;
        width: 7rem;
        height: 2.5rem;
        /* Reduced height to match other buttons */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.3s;
        border: 1px solid var(--primary-color);
        color: var(--secondary-color);
    }

    .lang-switch-btn:hover {
        background-color: var(--primary-color);
        color: white;
    }

    @media (max-width: 1279px) {
        .lang-switch-btn {
            width: 100%;
        }
    }
</style>

@push('script')
    <script>
        const menu_btn = document.getElementById('menu_btn');
        const menu_content = document.getElementById('menu_content');
        const menu_icon = document.getElementById('menu_icon');
        const close_icon = document.getElementById('close_icon');
        const close_menu = document.getElementById('close_menu');

        let isMenuOpen = false;

        function toggleMenu() {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                menu_content.classList.remove('translate-x-full', 'hidden');
                menu_icon.classList.add('hidden');
                close_icon.classList.remove('hidden');
            } else {
                menu_content.classList.add('translate-x-full');
                setTimeout(() => {
                    menu_content.classList.add('hidden');
                }, 300); // Match this with your transition duration
                menu_icon.classList.remove('hidden');
                close_icon.classList.add('hidden');
            }
        }

        menu_btn.addEventListener('click', toggleMenu);
        close_menu.addEventListener('click', toggleMenu);
    </script>
@endpush
