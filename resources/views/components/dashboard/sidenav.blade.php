<aside class="min-h-screen  px-8 bg-white shadow hidden md:block col-span-12 sm:col-span-2 md:col-span-2 xl:col-span-1"
:class="{'block col-span-12 fixed bg-gray-100 z-50 top-0 w-full left-0 right-0 h-full overflow-scroll': open, 'hidden': ! open}"
>
    <div class="py-6 space-y-7">
        {{-- Dashboard --}}
        <div>
            <x-sidenav.title>
                {{ __('Dashboard') }}
            </x-sidenav.title>
            <div>
                <x-sidenav.link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    <x-zondicon-user class="w-3 text-green-400" />
                    <span>{{ __('Profile') }}</span>
                </x-sidenav.link>
            </div>

            <div>
                <x-sidenav.link href="{{ route('users') }}" :active="request()->routeIs('users')">
                    <x-zondicon-user-group class="w-3 text-green-400" />
                    <span>{{ __('Users') }}</span>
                </x-sidenav.link>
            </div>

            <div>
                <x-sidenav.link href="{{ route('dashboard.notifications.index') }}" :active="request()->routeIs('dashboard.notifications.index')">
                    <x-zondicon-notifications-outline class="w-3 text-green-400" />
                    <span>{{ __('Notifications') }}</span>
                </x-sidenav.link>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
        {{-- Categories --}}
        <div>
            <x-sidenav.title>
                {{ __('Categories') }}
            </x-sidenav.title>
            <div>
                <x-sidenav.link href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.index')">
                    <x-zondicon-view-tile class="w-3 text-green-400" />
                    <span>{{ __('Index') }}</span>
                </x-sidenav.link>
            </div>
            <div>
                <x-sidenav.link href="{{ route('admin.categories.create') }}" :active="request()->routeIs('admin.categories.create')">
                    <x-zondicon-compose class="w-3 text-green-400" />
                    <span>{{ __('Create') }}</span>
                </x-sidenav.link>
            </div>
        </div>
        @endif

        @if(auth()->user()->isAdmin())
        {{-- Tags --}}
        <div>
            <x-sidenav.title>
                {{ __('Tags') }}
            </x-sidenav.title>
            <div>
                <x-sidenav.link href="{{ route('admin.tags.index') }}" :active="request()->routeIs('admin.tags.index')">
                    <x-zondicon-view-tile class="w-3 text-green-400" />
                    <span>{{ __('Index') }}</span>
                </x-sidenav.link>
            </div>
            <div>
                <x-sidenav.link href="{{ route('admin.tags.create') }}" :active="request()->routeIs('admin.tags.create')">
                    <x-zondicon-compose class="w-3 text-green-400" />
                    <span>{{ __('Create') }}</span>
                </x-sidenav.link>
            </div>
        </div>
        @endif

        {{-- Threads --}}
        <div>
            <x-sidenav.title>
                {{ __('Threads') }}
            </x-sidenav.title>
            <div>
                <x-sidenav.link href="{{ route('threads.index') }}" :active="request()->routeIs('threads.index')">
                    <x-zondicon-view-tile class="w-3 text-green-400" />
                    <span>{{ __('Index') }}</span>
                </x-sidenav.link>
            </div>
        </div>

        {{-- Authentication --}}
        <div>
            <x-sidenav.title>
                {{ __('Authentication') }}
            </x-sidenav.title>
            <div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-sidenav.link href="{{ route('logout') }}" onclick="event.preventDefault();                                               this.closest('form').submit();">
                        <x-heroicon-o-logout class="w-4 text-green-400" />
                        <span>{{ __('Logout') }}</span>
                    </x-sidenav.link>

                </form>

            </div>
        </div>
        <div class="flex justify-center items-center">
            <!-- Hamburger -->
            <div class="flex items-center -mr-2 rounded-full bg-gray-700 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</aside>
