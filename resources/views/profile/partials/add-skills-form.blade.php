<section class="space-y-6">
  <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          {{ __('Add Skills') }}
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          {{ __('Here you can add your most relevent skills to get personalized job recommendations.') }}
      </p>
  </header>

<div class="p-2.5 rounded-lg flex flex-wrap justify-start items-center bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none">
            <div class='px-1'>
                    <div class='dark:bg-primary-900 flex justify-center items-center rounded gap-1 py-1 px-2 text-primary-300 mt-1'>
                    <span class="text-xs font-medium text-primary-300">{tag}</span>
                    <button type="button">
                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    </button>
                    </div>
                </div>
  <input type="text" name="item-weight" id="item-weight" class="ml-1 rounded-lg outline-none focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Add Tags here" required/>
    </input>
  </div>

</section>