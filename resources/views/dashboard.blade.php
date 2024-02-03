<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- flash login success message --}}
    @session('loginMessage')
        <div class="max-w-7xl mx-auto pt-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __(session('loginMessage')) }}
                </div>
            </div>
        </div>
        {{ session()->forget("loginMessage")}}
    @endsession

    @if($errors->any())
    <div class="max-w-7xl mx-auto pt-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ($errors->all() as $error)
            <div class="py-3 px-6  text-gray-900 dark:text-gray-100">
                {{$error}}
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- render the data tables --}}
    @switch(request()->route()->getName())
    @case("partner.index")
    @case("dashboard.partners")
        <x-partners-table :partners="$partners" :searchQuery="$searchQuery"/>
        @break
    @case("advert.index")
    @case("dashboard")
        <x-adverts-table :adverts="$adverts" :searchQuery="$searchQuery"/>
        @break
    @default
        <x-adverts-table :adverts="$adverts" :searchQuery="$searchQuery"/>
        @break
    @endswitch


</x-app-layout>
