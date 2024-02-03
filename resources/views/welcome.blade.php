<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js', 'node_modules/flowbite/dist/flowbite.min.js', 'resources/js/script.js'])
        <script src="{{ asset('assets/js/theme.js') }}"></script>
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 flex gap-2 justify-center items-center">
                    <x-theme-switcher/>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <img class="h-12 w-auto" src="{{ asset('storage/youtalent/' . "youtalent-high-resolution-logo-transparent.webp") }}" id="welcomeLogo" alt="App Logo">
                </div>

                <div class="mt-16 flex flex-col gap-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        @forelse ($adverts as $advert)
                        <a href="{{'/advert/show/' . $advert->id}}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div class="flex flex-col h-full justify-between items-start">
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <img class="rounded-full h-16 w-16" src="{{ asset('storage/logos/' . $advert->partnerLogo) }}" alt="{{ $advert->partnerName }} Logo">
                                </div>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ \Illuminate\Support\Str::limit($advert->title, $limit = 100, $end = '...') }}</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit($advert->content, $limit = 200, $end = '...') }}
                                </p>
                                <div class="flex justify-between w-full items-center pt-2">
                                    <div><p class="bg-purple-200 text-purple-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-purple-600 dark:text-purple-300">
                                        {{$advert->partner->name}}
                                    </p></div>
                                    <div class="flex justify-center items-center gap-1">
                                        <p class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">{{$advert["partner"]["industry"]}}</p>
                                    </div>
                                    <p class="
                                    {{ $advert->partner->size === 'small' ? 'bg-red-200 text-red-800 dark:bg-red-600 dark:text-red-300' : '' }}
                                    {{ $advert->partner->size === 'medium' ? 'bg-gray-500 text-gray-200 dark:bg-gray-700 dark:text-gray-300' : '' }}
                                    {{ $advert->partner->size === 'large' ? 'bg-green-200 text-green-800 dark:bg-green-600 dark:text-green-300' : '' }}
                                    text-xs font-medium px-2 py-0.5 rounded">
                                    {{ $advert->partner->size }}
                                    </p>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-[#038DFE] w-6 h-6 mx-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                            </svg>
                        </a>
                        @empty
                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    No Company Announcements are available at this moment. Please check again later!
                                </p>
                            </div>
                        </div>
                        @endforelse
                        </div>
                            {{$adverts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
