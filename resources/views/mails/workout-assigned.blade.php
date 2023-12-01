<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('New workout assigned')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
        <header>
            <a href="#">
                <img class="w-auto h-7 sm:h-8" src="https://merakiui.com/images/full-logo.svg" alt="">
            </a>
        </header>
    
        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200">{{__('Hi')}} {{ $user->name }},</h2>
    
            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                {{$trainer->name}} {{__('has assigned you a new workout')}}: <span class="font-semibold ">{{ $workout->title }}</span>
            </p>
            
            <a target="_blank" href="{{route('workouts.edit', $workout->id)}}" class="inline-block px-6 py-2 mt-4 text-sm font-medium tracking-wider text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                {{__('See workout')}}
            </a>
        </main>
        
        <footer class="mt-8">
            <p class="mt-3 text-gray-500 dark:text-gray-400">© {{date('Y')}} {{ config('app.name', 'Laravel') }}. {{__('All rights reserved')}}.</p>
        </footer>
    </section>
</body>
</html>