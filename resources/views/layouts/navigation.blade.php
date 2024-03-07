<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <svg class="block h-[1rem] w-auto" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="2000" height="308" viewBox="0 0 2000 308"><g transform="matrix(1,0,0,1,-1.2121212121212466,0.9062158113255236)"><svg viewBox="0 0 396 61" data-background-color="#293040" preserveAspectRatio="xMidYMid meet" height="308" width="2000" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="tight-bounds" transform="matrix(1,0,0,1,0.2400000000000091,-0.17947780678849767)"><svg viewBox="0 0 395.52 61.35895561357702" height="61.35895561357702" width="395.52"><g><svg viewBox="0 0 395.52 61.35895561357702" height="61.35895561357702" width="395.52"><g><svg viewBox="0 0 395.52 61.35895561357702" height="61.35895561357702" width="395.52"><g id="textblocktransform"><svg viewBox="0 0 395.52 61.35895561357702" height="61.35895561357702" width="395.52" id="textblock"><g><svg viewBox="0 0 395.52 61.35895561357702" height="61.35895561357702" width="395.52"><g transform="matrix(1,0,0,1,0,0)"><svg width="395.52" viewBox="0.55 -35 229.78 35.65" height="61.35895561357702" data-palette-color="#ffffff"><path d="M23.2-34.5L27.85-34.5 16.2-11.7 12.25-11.7 0.55-34.5 5.25-34.5 12.5-19.95Q12.95-19 13.33-18 13.7-17 14.05-16.05L14.05-16.05 14.4-16.05Q14.75-17 15.15-18 15.55-19 15.95-19.9L15.95-19.9 23.2-34.5ZM12-14.8L16.4-14.8 16.4 0 12 0 12-14.8ZM42.65-24.95L42.65-24.95Q46.85-24.95 49.37-23.7 51.9-22.45 53-19.63 54.1-16.8 54.1-12.15L54.1-12.15Q54.1-7.5 53-4.67 51.9-1.85 49.37-0.6 46.85 0.65 42.65 0.65L42.65 0.65Q38.5 0.65 35.97-0.6 33.45-1.85 32.32-4.67 31.2-7.5 31.2-12.15L31.2-12.15Q31.2-16.8 32.32-19.63 33.45-22.45 35.97-23.7 38.5-24.95 42.65-24.95ZM42.65-21.35L42.65-21.35Q40-21.35 38.47-20.53 36.95-19.7 36.3-17.7 35.65-15.7 35.65-12.15L35.65-12.15Q35.65-8.6 36.3-6.6 36.95-4.6 38.47-3.78 40-2.95 42.65-2.95L42.65-2.95Q45.3-2.95 46.85-3.78 48.4-4.6 49.05-6.6 49.7-8.6 49.7-12.15L49.7-12.15Q49.7-15.7 49.05-17.7 48.4-19.7 46.85-20.53 45.3-21.35 42.65-21.35ZM60.6-24.35L64.84-24.35 64.84-7.25Q64.8-4.95 65.7-4 66.59-3.05 68.7-3.05L68.7-3.05Q70.75-3.05 72.77-4.03 74.8-5 77.65-6.85L77.65-6.85 78.2-3.9Q75.34-1.65 72.67-0.5 70 0.65 67.25 0.65L67.25 0.65Q60.6 0.65 60.6-6.05L60.6-6.05 60.6-24.35ZM77.2-24.35L81.45-24.35 81.45 0 78.05 0 77.65-4.6 77.2-5.35 77.2-24.35ZM97.64-34.5L102.04-34.5 102.04 0 97.64 0 97.64-34.5ZM86.54-34.5L113.19-34.5 113.19-30.6 86.54-30.6 86.54-34.5ZM129.79-24.95L129.79-24.95Q132.49-24.95 134.37-24.23 136.24-23.5 137.19-21.8 138.14-20.1 138.14-17.15L138.14-17.15 138.14 0 134.79 0 134.14-5.3 133.84-5.85 133.84-17.15Q133.84-19.4 132.81-20.38 131.79-21.35 128.89-21.35L128.89-21.35Q126.99-21.35 124.12-21.15 121.24-20.95 118.44-20.7L118.44-20.7 118.04-23.85Q119.74-24.15 121.77-24.4 123.79-24.65 125.89-24.8 127.99-24.95 129.79-24.95ZM123.69-15L136.14-15 136.09-11.8 124.44-11.75Q122.69-11.7 121.99-10.83 121.29-9.95 121.29-8.4L121.29-8.4 121.29-6.85Q121.29-4.95 122.19-4.08 123.09-3.2 125.09-3.2L125.09-3.2Q126.49-3.2 128.26-3.73 130.04-4.25 131.84-5.35 133.64-6.45 135.14-8.15L135.14-8.15 135.14-5Q134.59-4.3 133.56-3.38 132.54-2.45 131.12-1.58 129.69-0.7 127.97-0.13 126.24 0.45 124.24 0.45L124.24 0.45Q122.09 0.45 120.44-0.33 118.79-1.1 117.86-2.63 116.94-4.15 116.94-6.35L116.94-6.35 116.94-9Q116.94-11.85 118.72-13.43 120.49-15 123.69-15L123.69-15ZM145.79-35L150.04-35 149.99-6.7Q149.99-5.1 150.86-4.28 151.74-3.45 153.34-3.45L153.34-3.45 155.69-3.45 156.19-0.2Q155.74 0 154.91 0.15 154.09 0.3 153.21 0.38 152.34 0.45 151.74 0.45L151.74 0.45Q149.04 0.45 147.41-1.15 145.79-2.75 145.79-5.75L145.79-5.75 145.79-35ZM170.59-24.95L170.59-24.95Q176.09-24.95 178.56-22.95 181.03-20.95 181.03-17L181.03-17Q181.09-13.75 179.69-11.93 178.28-10.1 175.24-10.1L175.24-10.1 161.03-10.1 161.03-13.4 174.13-13.4Q175.78-13.4 176.28-14.53 176.78-15.65 176.78-17L176.78-17Q176.74-19.35 175.38-20.35 174.03-21.35 170.78-21.35L170.78-21.35Q168.13-21.35 166.61-20.58 165.09-19.8 164.46-17.88 163.84-15.95 163.84-12.5L163.84-12.5Q163.84-8.6 164.61-6.55 165.38-4.5 167.09-3.75 168.78-3 171.59-3L171.59-3Q173.53-3 175.86-3.18 178.19-3.35 180.03-3.6L180.03-3.6 180.49-0.75Q179.34-0.3 177.66 0 175.99 0.3 174.21 0.45 172.44 0.6 171.03 0.6L171.03 0.6Q166.84 0.6 164.28-0.68 161.74-1.95 160.56-4.78 159.38-7.6 159.38-12.25L159.38-12.25Q159.38-17.05 160.56-19.83 161.74-22.6 164.21-23.78 166.69-24.95 170.59-24.95ZM202.23-24.95L202.23-24.95Q208.83-24.95 208.83-18.25L208.83-18.25 208.83 0 204.58 0 204.58-17.05Q204.58-19.5 203.78-20.43 202.98-21.35 201.08-21.35L201.08-21.35Q198.83-21.35 196.58-20.25 194.33-19.15 191.23-17.25L191.23-17.25 191.03-20.3Q193.88-22.5 196.68-23.73 199.48-24.95 202.23-24.95ZM187.43-24.35L191.03-24.35 191.38-19.7 191.68-18.95 191.68 0 187.43 0 187.43-24.35ZM218.33-31.55L222.58-31.55 222.58-6.7Q222.58-4.95 223.33-4.2 224.08-3.45 225.88-3.45L225.88-3.45 229.58-3.45 230.08-0.2Q229.28 0 228.23 0.15 227.18 0.3 226.18 0.38 225.18 0.45 224.58 0.45L224.58 0.45Q221.53 0.45 219.93-1.25 218.33-2.95 218.33-6.15L218.33-6.15 218.33-31.55ZM218.73-24.35L230.33-24.35 230.33-21 213.93-21 213.93-24.1 218.73-24.35Z" opacity="1" transform="matrix(1,0,0,1,0,0)" class="wordmark-text-0 fill-grey-500 dark:fill-white" data-fill-palette-color="primary" id="text-0"></path></svg></g></svg></g></svg></g></svg></g></svg></g><defs></defs></svg><rect width="395.52" height="61.35895561357702" fill="none" stroke="none" visibility="hidden"></rect></g></svg></g></svg>
                    </a>
                </div>
                <!-- Navigation Links -->
               @if (auth()->check() && auth()->user()->can("access-admin-dashboard"))
               <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Announcements') }}
                </x-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('dashboard.partners')" :active="request()->routeIs('dashboard.partners')">
                    {{ __('Partners') }}
                </x-nav-link>
            </div>
            @if (auth()->user()->hasPermissionTo('manage roles'))
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                    {{ __('Users') }}
                </x-nav-link>
            </div>
            @endif
        </div>
        @else
        {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link :href="route('dashboard.applications')" :active="request()->routeIs('dashboard.applications')">
                {{ __('Applications') }}
            </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link :href="route('dashboard.recommendation')" :active="request()->routeIs('dashboard.recommendation')">
                {{ __('Job Recommendations') }}
            </x-nav-link>
        </div> --}}
    </div>
               @endif

            <!-- Settings Dropdown -->
            <div class="flex flex-row justify-center items-center">
                <x-theme-switcher/>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{  Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        {{-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div> --}}

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
