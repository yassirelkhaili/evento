<section class="mt-8 px-4">
    <div class="flex flex-col gap-4 justify-center items-start">
        @forelse ($recommendations as $recommendation)
        <div class="flex flex-row justify-between items-center w-full bg-white dark:bg-gray-800 px-6 py-4 rounded-lg">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-400">
                    {{ $recommendation["title"] }}
                </div>
            </div>
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-400">
                    {{ $recommendation["partner"][0] }}
                </div>
            </div>
            <form action="{{ route("application.store") }}" method="post">
                @csrf
                <input type="hidden" name="bookingId" value={{ $recommendation['id'] }}>
                <button type="submit" id="createProductModalButton" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Click to Apply
                </button>
            </form>
        </div>
        @empty
        <div class="mx-auto pt-12 flex flex-row justify-between items-center w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    No recommendations at this moment
                </div>
            </div>
        </div>
        @endforelse
    </div>
</section>