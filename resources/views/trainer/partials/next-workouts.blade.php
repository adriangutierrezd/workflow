<article class="p-4 bg-white dark:text-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
    
    <header>
        <h2 class="card-heading-2">Próximos entrenamientos</h2>
    </header>

    <main>

        <ul class="flex sm:overflow-x-scroll text-sm font-medium text-center text-gray-500 dark:text-gray-400 mt-4">

            @foreach($weekDays as $weekDay)
                @if($weekDay['date'] == date('Y-m-d'))
                    <li 
                    class="mr-2 flex-items-center justify-center flex flex-col px-4 py-3 rounded-lg text-white bg-blue-600 active"
                    >
                        <span>{{ $weekDay['number'] }}</span>
                        <span>{{ Str::limit(__($weekDay['name']), 3, '') }}</span>
                    </li>
                @else 
                    <li 
                    class="mr-2 flex-items-center justify-center flex flex-col px-4 py-3 rounded-lg text-gray-800 bg-gray-200 pointer"
                    >
                        <span>{{ $weekDay['number'] }}</span>
                        <span>{{ Str::limit(__($weekDay['name']), 3, '') }}</span>
                    </li>
                @endif
            @endforeach
            {{-- <li class="mr-2 flex-items-center justify-center flex flex-col px-4 py-3 text-white bg-blue-600 rounded-lg active" aria-current="page">
                <span>09</span>
                <span>Lun</span>
            </li>
    
            <li class="mr-2 flex-items-center justify-center flex flex-col px-4 py-3 text-gray-800 bg-gray-200 rounded-lg pointer">
                <span>10</span>
                <span>Mar</span>
            </li>
     --}}
            
    
        </ul>

        <section class="mt-4">
            <div class="flex items-center justify-between border-l-4 border-blue-600 p-2 mt-3">
                <div>
                    <h3 class="text-md font-medium text-gray-800 dark:text-white">Lorem ipsum dolor</h3>
                    <div class="flex items-center justify-start mt-2">
                        <img class="object-cover w-6 h-6 rounded-full" src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&h=764&q=100" alt="">
                        <span class="ml-2 text-gray-600">John Doe</span>
                    </div>
                </div>
                <a href="#" class="hover:text-blue-600" title="Ver entrenamiento">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </a>
            </div>

        
            <div class="flex items-center justify-between border-l-4 border-blue-600 p-2 mt-3">
                <div>
                    <h3 class="text-md font-medium text-gray-800 dark:text-white">Lorem ipsum dolor</h3>
                    <div class="flex items-center justify-start mt-2">
                        <img class="object-cover w-6 h-6 rounded-full" src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&h=764&q=100" alt="">
                        <span class="ml-2 text-gray-600">John Doe</span>
                    </div>
                </div>
                <a href="#" class="hover:text-blue-600" title="Ver entrenamiento">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </a>
            </div>

            <div class="flex items-center justify-between border-l-4 border-blue-600 p-2 mt-3">
                <div>
                    <h3 class="text-md font-medium text-gray-800 dark:text-white">Lorem ipsum dolor</h3>
                    <div class="flex items-center justify-start mt-2">
                        <img class="object-cover w-6 h-6 rounded-full" src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&h=764&q=100" alt="">
                        <span class="ml-2 text-gray-600">John Doe</span>
                    </div>
                </div>
                <a href="#" class="hover:text-blue-600" title="Ver entrenamiento">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </a>
            </div>


        </section>

    </main>

</article>