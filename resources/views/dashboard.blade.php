<x-app-layout>
    
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

    @if(session('success'))
    <div class="max-w-7xl mx-auto pt-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-3 px-6  text-gray-900 dark:text-gray-100">
                {{session()->get('success')}}
            </div>
        </div>
    </div>
    @endif

    {{-- render the data tables --}}
    @if (auth()->user())
    @switch(request()->route()->getName())
        @case("dashboard.users")
        @case("user.index")
    <x-users-table :users="$users" :searchQuery="$searchQuery" :availableRoles="$availableRoles"/>    
        @break
    @default
        <x-events-table :events="$events" :searchQuery="$searchQuery" :categories="$categories"/>
        @break
    @endswitch
    @else 
        @switch(request()->route()->getName())
            @case("dashboard.applications")
            @case("application.index")
            <x-applications-table :applications="$applications" :searchQuery="$searchQuery" />
                @break
                @case("dashboard.recommendation")
                @case("recommendation.index")
            <x-recommendations-table :recommendations="$recommendations" :searchQuery="$searchQuery" />
                @break
            @default
            <x-applications-table :applications="$applications" :searchQuery="$searchQuery" />
                @break;
        @endswitch
    @endif


</x-app-layout>
