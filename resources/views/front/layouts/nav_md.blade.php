<div id="menu_content"
    class=" xl:hidden py-4 px-4 top-[1px] bg-white shadow absolute left-[-100%] w-full z-50 transition duration-600"
    {{ app()->getLocale() == 'ar' ? 'data-aos=fade-right' : 'data-aos=fade-left' }}>
    <ul class="flex flex-col items-start justify-center gap-8">
        <li>
            <a href="{{ route('about.index') }}" class="link">
                <span>{{ __('front.about_itihad') }}</span>
            </a>
        </li>

        <li>
            <a href="{{ route('join_us.show') }}" class="link">
                <span>{{ __('front.home') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('join_us.show') }}" class="link">
                <span>{{ __('front.join-us') }}</span>
            </a>
        </li>

        <li>
            <a href="{{ route('faq.index') }}" class="link">
                <span>{{ __('front.faq') }}</span>
            </a>
        </li>

        <li>
            <a href="#contact-us" class="link">
                <span>{{ __('front.contact-us') }}</span>
            </a>
        </li>





        <li>
            <a href="{{ route('dashboard.login.index') }}" class="link">
                <span>{{ __('front.login') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('dashboard.register') }}" class="link">
                <span>{{ __('front.register') }}</span>
            </a>
        </li>


        @if (getLocale() == 'en')
            <li>
                <a href="{{ route('lang.switchLang', 'ar') }}"
                    class=" text-sm  w-20 h-8 md:text-base md:w-28 md:h-12 flex items-center justify-center rounded-xl font-normal transition duration-300 border border-primary text-secondary hover:bg-primary hover:text-white">
                    العربية
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('lang.switchLang', 'en') }}"
                    class="text-sm  w-20 h-8 md:text-base md:w-28 md:h-12 flex items-center justify-center rounded-xl font-normal transition duration-300 border border-primary text-secondary hover:bg-primary hover:text-white">
                    English
                </a>
            </li>
        @endif
    </ul>
</div>
