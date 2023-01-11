<aside class="hidden md:block col-span-1 space-y-6 text-gray-600"
    :class="{'block col-span-12 fixed bg-gray-100 z-50 top-0 w-full left-0 right-0 h-full overflow-scroll': open, 'hidden': ! open}"
>
    <div class="p-4 bg-white shadow">
        <div class="flex items-center justify-between h-8 space-x-12">
            {{-- Start Discusson Button --}}
            <a href="{{ route('threads.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-500 border border-transparent rounded hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25" }}>
                {{ __('Bắt đầu thảo luận') }}
            </a>
            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        @auth
        @if(request()->routeIs('threads.show'))
        <div class="pb-4 space-y-4">

            @can(App\Policies\ThreadPolicy::UNSUBSCRIBE, $thread)
            {{-- Unubscribe to thread button --}}
            <x-links.main href="{{ route('threads.unsubscribe', [$thread->category->slug(), $thread->slug()]) }}">
                {{ __('Unsubscribe to Thread') }}
            </x-links.main>
            <p class="text-sm text-gray-500 ">
                Unsubscribe from this thread.
            </p>

            @elsecan(App\Policies\ThreadPolicy::SUBSCRIBE, $thread)
            {{-- Subscribe to thread button --}}
            <x-links.main href="{{ route('threads.subscribe', [$thread->category->slug(), $thread->slug()]) }}">
                {{ __('Subscribe to Thread') }}
            </x-links.main>
            <p class="text-sm text-gray-500 ">
                Subscribe to this thread.
            </p>
            @endcan

        </div>
        @endif
        @endauth
        {{-- Categories --}}
        <livewire:category />
        {{-- Tag --}}
        <livewire:tag />
        {{-- Phổ biến trong tuần này --}}
        <div class="p-4 bg-white border-t">
            <ul class="space-y-4 text-gray-500">
                <li>
                    <a href="#" class="flex items-center space-x-2">
                        <x-heroicon-s-star class="w-5 h-5 text-yellow-500" />
                        <span>Phổ biến trong tuần này</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center space-x-2">
                        <x-heroicon-s-fire class="w-5 h-5 text-red-600" />
                        <span>Phổ biến mọi thời đại</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center space-x-2">
                        <x-heroicon-s-chat class="w-5 h-5 text-blue-400" />
                        <span>Chưa có câu trả lời</span>
                    </a>
                </li>
                
            </ul>
        </div>
        {{-- End Phổ biến trong tuần này --}}
        <div class="p-4">
            @auth
            <!-- Account Management -->
            <div class="pb-4 mb-4 border-b border-gray-200">
                <h2 class="font-bold uppercase">{{ __('Quản lý tài khoản') }}</h2>
            </div>
            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                {{ __('Thông tin cá nhân') }}
            </x-jet-dropdown-link>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ __('Đăng xuất') }}
                </x-jet-dropdown-link>
            </form>
            @else
            <div class="space-x-4">
                <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-jet-nav-link>
        
                <x-jet-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-jet-nav-link>
            </div>
            @endauth
        </div>
    </div>
</aside>
