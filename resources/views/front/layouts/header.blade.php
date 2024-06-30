<nav class="shadow-md overflow-hidden">
    <div class="container px-6 md:px-0 md:w-8/12 mx-auto">
        <div class="flex justify-between  gap-8 items-center h-[130px]">
            <div {{ app()->getLocale() == 'ar' ? 'data-aos=fade-left' : 'data-aos=fade-right' }}
                class="flex items-center gap-3">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(\App\Models\Setting::where('setting_key', 'logo')->first()->setting_value) }}"
                        alt="logo" class=" w-36" />
                </a>

                <a href="{{ route('home') }}" class="hidden xl:block link">
                    {{ __('front.home') }}
                </a>

            </div>
            <div class="hidden xl:block"
                {{ app()->getLocale() == 'ar' ? 'data-aos=fade-right' : 'data-aos=fade-left' }}>
                <ul class="flex flex-wrap   items-center justify-center gap-4  ">

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
            <button class="xl:hidden" id="menu_btn">
                <img src="{{ asset('assets/menu.png') }}" width="36" alt="">
            </button>
        </div>
    </div>
</nav>




@push('script')
    <script>
        const menu_btn = document.getElementById('menu_btn');
        const menu_content = document.getElementById('menu_content');
        menu_btn.addEventListener('click', () => {
            menu_content.classList.toggle('left-[-100%]');
            menu_content.classList.toggle('left-0');
        });
    </script>
@endpush
