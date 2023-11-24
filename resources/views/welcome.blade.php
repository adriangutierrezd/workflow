<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <header class="bg-white dark:bg-gray-900">
            <nav x-data="{ isOpen: false }" class="relative bg-white dark:bg-gray-900">
                <div class="container px-6 py-4 mx-auto md:flex md:justify-between md:items-center">
                    <div class="flex items-center justify-between">
                        <a href="#">
                            <img class="w-auto h-6 sm:h-7" src="https://merakiui.com/images/full-logo.svg" alt="">
                        </a>
            
                        <!-- Mobile menu button -->
                        <div class="flex md:hidden">
                            <button x-cloak @click="isOpen = !isOpen" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                                <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                                </svg>
        
                                <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
            
                    <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                    <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white dark:bg-gray-900 md:bg-transparent md:dark:bg-transparent md:mt-0 md:p-0 md:top-0 md:relative md:w-auto md:opacity-100 md:translate-x-0 md:flex md:items-center">
                        <div class="flex flex-col md:flex-row md:mx-6">

                            @if (Route::has('login'))
                                @auth
                                        <a class="my-2 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400 md:mx-4 md:my-0" href="{{ url('/dashboard') }}">{{__('Dashboard')}}</a>
                                    @else
                                        <a href="{{ route('login') }}" class="my-2 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400 md:mx-4 md:my-0">{{__('Log in')}}</a>
                
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="my-2 text-gray-700 transition-colors duration-300 transform dark:text-gray-200 hover:text-blue-500 dark:hover:text-blue-400 md:mx-4 md:my-0">{{__('Register')}}</a>
                                        @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        
            <div class="container px-6 py-16 mx-auto">
                <div class="items-center lg:flex">
                    <div class="w-full lg:w-1/2">
                        <div class="lg:max-w-lg">
                            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white lg:text-4xl">{{__('Keep track of')}}<br> {{__('your')}} <span class="text-blue-500 lowercase">{{__('Workouts')}}</span></h1>
                            
                            <p class="mt-3 text-gray-600 dark:text-gray-400">{{__('Track and analyze your workouts at the gym to get the best results')}}.</p>
                            
                            <button 
                            class="w-full px-5 py-2 mt-6 
                            text-sm tracking-wider text-white uppercase 
                            transition-colors duration-300 transform bg-blue-600 
                            rounded-lg lg:w-auto hover:bg-blue-500 focus:outline-none 
                            focus:bg-blue-500">{{__('Start now')}}</button>
                        </div>
                    </div>
        
                    <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" class="h-80 w-96" viewBox="0 0 892.34963 579.10966" xmlns:xlink="http://www.w3.org/1999/xlink"><title>fitness_stats</title><path d="M837.481,708.97279l46.45777-69.08737-46.36275,76.51984.09695,7.77406q-5.08741.03879-10.076-.16943l2.3042-99.93046-.06313-.77093.085-.149.22054-9.44283-50.87674-73.8671,50.81671,66.79969.18034,1.99592,1.74041-75.50137-43.9438-76.58326,44.06895,63.31984-.46-156.41937.001-.52062.015.512L834.60258,486.732l40.04952-50.07621-39.91841,60.69646.87411,67.53422,36.85379-65.91084-36.71835,75.83953.48658,37.55243,53.59536-91.813L836.39275,625.468Z" transform="translate(-153.82518 -160.44517)" fill="#e6e6e6"/><path d="M993.83068,711.14892l46.45777-69.08736-46.36276,76.51983.09695,7.77406q-5.0874.03879-10.076-.16943l2.3042-99.93046-.06313-.77093.085-.149.22054-9.44282-50.87674-73.86711,50.81671,66.79969.18033,1.99592L988.354,535.32l-43.94379-76.58326,44.06894,63.31984-.46-156.41937.001-.52062.01495.512,2.91709,123.27952,40.04952-50.07621-39.9184,60.69646.8741,67.53422,36.85379-65.91084-36.71834,75.83953.48658,37.55243,53.59536-91.813L992.74239,627.64414Z" transform="translate(-153.82518 -160.44517)" fill="#e6e6e6"/><rect x="92" width="278.00787" height="376.03942" fill="#e6e6e6"/><rect x="101.79647" y="13.25091" width="258.41494" height="349.5376" fill="#fff"/><path d="M480.07005,235.004H290.41637a5.79728,5.79728,0,0,1,0-11.59455H480.07005a5.79728,5.79728,0,1,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#e6e6e6"/><path d="M480.07005,294.63305H290.41637a5.79728,5.79728,0,0,1,0-11.59455H480.07005a5.79728,5.79728,0,1,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#e6e6e6"/><path d="M480.07005,354.26216H290.41637a5.79728,5.79728,0,0,1,0-11.59455H480.07005a5.79728,5.79728,0,1,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#e6e6e6"/><path d="M480.07005,413.89126H290.41637a5.79728,5.79728,0,0,1,0-11.59455H480.07005a5.79728,5.79728,0,1,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#e6e6e6"/><path d="M480.07005,473.52037H290.41637a5.79728,5.79728,0,0,1,0-11.59455H480.07005a5.79728,5.79728,0,1,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#e6e6e6"/><path d="M446.94277,235.004H289.58819a5.79728,5.79728,0,1,1,0-11.59455H446.94277a5.79728,5.79728,0,0,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#3b82f6"/><path d="M398.08,294.63305H289.58819a5.79727,5.79727,0,1,1,0-11.59455H398.08a5.79728,5.79728,0,1,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#3b82f6"/><path d="M338.45093,354.26216H289.58819a5.79728,5.79728,0,1,1,0-11.59455h48.86274a5.79728,5.79728,0,0,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#3b82f6"/><path d="M461.85005,413.89126H289.58819a5.79727,5.79727,0,1,1,0-11.59455H461.85005a5.79727,5.79727,0,0,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#3b82f6"/><path d="M423.75367,473.52037H289.58819a5.79728,5.79728,0,1,1,0-11.59455H423.75367a5.79728,5.79728,0,1,1,0,11.59455Z" transform="translate(-153.82518 -160.44517)" fill="#3b82f6"/><rect y="563.74025" width="888" height="2" fill="#3f3d56"/><path d="M659.81305,431.35258s-6.28548-46.0935-16.76127-33.52254,0,31.42738,0,31.42738l8.38063,10.47579,8.38064-6.28547Z" transform="translate(-153.82518 -160.44517)" fill="#9f616a"/><path d="M684.955,446.01869s-20.95158-23.04675-25.1419-18.85643-16.76127,6.28548-14.66611,14.66611,46.09349,35.6177,46.09349,35.6177Z" transform="translate(-153.82518 -160.44517)" fill="#3b82f6"/><path d="M684.955,446.01869s-20.95158-23.04675-25.1419-18.85643-16.76127,6.28548-14.66611,14.66611,46.09349,35.6177,46.09349,35.6177Z" transform="translate(-153.82518 -160.44517)" opacity="0.1"/><path d="M804.379,443.92353V460.6848s2.09516,37.71286-10.47579,35.6177S787.61773,462.78,787.61773,462.78l2.09516-18.85643Z" transform="translate(-153.82518 -160.44517)" fill="#9f616a"/><path d="M798.09353,565.44274S816.95,594.775,823.23543,596.87012s39.808,20.95159,43.99834,39.808L896.566,674.391l-14.66611,18.85643s-67.04508-71.2354-85.90151-77.52088-37.71286-37.71286-37.71286-37.71286Z" transform="translate(-153.82518 -160.44517)" fill="#9f616a"/><path d="M649.33725,517.25409s-39.808,6.28547-33.52254,31.42738,67.04508,77.52088,67.04508,77.52088L684.955,638.7733l23.04675,4.19032,10.47579-10.4758-2.09515-6.28547S691.24043,603.1556,689.14527,594.775s-25.1419-41.90317-35.6177-43.99833l14.66611-8.38064Z" transform="translate(-153.82518 -160.44517)" fill="#9f616a"/><path d="M890.28052,674.391s-8.38064-12.57095,4.19031-10.4758,20.95159,4.19032,20.95159,12.571-10.47579,67.04508-23.04675,62.85476-2.09515-23.04675-2.09515-23.04675-6.28548-16.76127-10.4758-18.85643-4.19032-12.57095,0-12.57095S892.37567,678.58132,890.28052,674.391Z" transform="translate(-153.82518 -160.44517)" fill="#2f2e41"/><path d="M712.192,628.2975s0-10.47579,8.38063,0,12.571,18.85643,4.19032,25.14191S687.05011,674.391,687.05011,674.391s-31.42738,6.28547-27.23706-8.38064c0,0,20.95159-10.47579,20.95159-18.85643s0-23.04674,6.28547-18.85643S712.192,634.583,712.192,628.2975Z" transform="translate(-153.82518 -160.44517)" fill="#2f2e41"/><path d="M752,471.16059s29.33223,4.19032,27.23707,46.0935c0,0,37.71286,37.71286,27.23706,50.28381s-33.52254,35.6177-41.90317,29.33222S731.04845,542.396,731.04845,542.396s-58.66445,20.95159-69.14024,10.4758-20.95159-35.6177-20.95159-35.6177l52.379-27.23707Z" transform="translate(-153.82518 -160.44517)" fill="#2f2e41"/><circle cx="516.46366" cy="166.14947" r="25.14191" fill="#9f616a"/><path d="M689.14527,328.6898s14.66611,23.04674,18.85643,25.1419-29.33222,23.04675-29.33222,23.04675,0-27.23707-10.4758-33.52254Z" transform="translate(-153.82518 -160.44517)" fill="#9f616a"/><path d="M691.24043,351.73654s33.52254-10.47579,39.808,6.28548S752,406.21067,749.90488,427.16226s-6.28548,16.76127,0,23.04675,10.47579,2.09516,8.38063,10.47579-4.19032,8.38064-2.09516,12.57095-25.1419,18.85643-48.18865,20.95159L684.955,496.3025s0-37.71286-4.19031-46.09349-12.571-25.14191-12.571-31.42739V402.15078a63.6067,63.6067,0,0,1,8.38063-31.55779v0S689.14527,351.73654,691.24043,351.73654Z" transform="translate(-153.82518 -160.44517)" fill="#3b82f6"/><path d="M716.38234,360.11718s77.52087,6.28547,85.90151,27.23706S814.8548,450.209,806.47416,450.209s-18.85643,4.19031-20.95158,0-10.4758-46.0935-12.571-46.0935S708.0017,397.83,708.0017,397.83,680.76464,364.3075,716.38234,360.11718Z" transform="translate(-153.82518 -160.44517)" fill="#3b82f6"/><path d="M669.27866,320.36163s-6.67194-11.59461-15.01174-1.52364-21.907-8.43622-19.82426-12.38526,9.4377.17757,22.04213-3.94283,36.88462-12.51446,40.951,14.86728-5.61826,24.51117-5.61826,24.51117-4.43915-24.26318-8.45126-17.29375l-4.01211,6.96943-3.48019.85654Z" transform="translate(-153.82518 -160.44517)" fill="#2f2e41"/></svg>
                    </div>
                </div>
            </div>
        </header>
        <main>

            {{-- Features --}}
            <section class="bg-white dark:bg-gray-900">
                <div class="container px-6 mx-auto">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                        <div>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                              
            
                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">{{__('Follow your progress')}}</h1>
            
                            <p class="mt-2 text-gray-500 dark:text-gray-400">{{__('Keep a record of your workouts so you can track your improvement and make future workouts more effective')}}.</p>
                        </div>
            
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                            </svg>
                              
            
                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">{{__('Take control of your workouts')}}</h1>
            
                            <p class="mt-2 text-gray-500 dark:text-gray-400">{{__("Create, delete and modify your workouts whenever you want, even if it's been weeks since you added them to the platform")}}.</p>
                        </div>
            
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />
                            </svg>
                              
            
                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">{{__('Use it at any time')}}</h1>
            
                            <p class="mt-2 text-gray-500 dark:text-gray-400">{{__('Workflow keeps an online record of your data, so you can access it at any time and from any device.')}}</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Call to action --}}
            <section class="bg-white dark:bg-gray-900">
                <div class="container flex flex-col items-center px-4 py-12 mx-auto text-center">
                    <h2 class="max-w-2xl mx-auto text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
                        {{__('Bring your workouts to')}} <span class="text-blue-500 lowercase">{{__('The next level')}}</span>
                    </h2>
            
                    <p class="max-w-4xl mt-6 text-center text-gray-500 dark:text-gray-300">
                        {{__('Forget about notebooks, cell phone notes or Word documents. Saving your training in digital format is easier than ever with Workflow')}}
                    </p>
            
                    <div class="inline-flex w-full mt-6 sm:w-auto">
                        <a href="{{ route('register') }}" class="inline-flex uppercase items-center justify-center w-full px-6 py-2 text-white duration-300 bg-blue-600 rounded-lg hover:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                            {{__('Register')}}
                        </a>
                    </div>
                </div>
            </section>

            {{-- Contact form --}}
            <section class="bg-white dark:bg-gray-900">

                <div class="container mx-auto px-4 py-12">
                    <h2 class="max-w-2xl mx-auto text-2xl text-center font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
                        {{__('Do you have any questions?')}}
                    </h2>

                    <form action="{{route('mail.contact-form')}}" x-data="{ submitting: false }" @submit="submitting = true" method="POST" id="demo-form" class="grid grid-cols-1 md:grid-cols-2 mt-6 gap-4">

                        @csrf

                        <div>
                            <x-input-label class="font-semibold capitalize">{{__('Name')}}</x-input-label>
                            <x-text-input type="text" name="name" class="w-full" required minLength="3"/>
                        </div>
    
                        <div>
                            <x-input-label class="font-semibold capitalize">{{__('email')}}</x-input-label>
                            <x-text-input type="email" name="email" class="w-full" required/>
                        </div>
    
                        <div class="md:col-span-2">
                            <x-input-label class="font-semibold">{{__('Type your message')}}</x-input-label>
                            <textarea name="message" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm" cols="30" rows="5"></textarea>    
                        </div>
    
                        <button 
                            :disabled="submitting"
                            class="w-full md:col-span-2 p-3 text-sm tracking-wider text-white uppercase transition-colors duration-300 transform bg-blue-600 rounded-lg lg:w-auto hover:bg-blue-500 focus:outline-none focus:bg-blue-500">{{__('Send')}}</button>
                    </form>

                </div>
            </section>

        </main>
        <footer class="bg-white dark:bg-gray-900">
            <div class="container flex flex-col items-center justify-between p-6 mx-auto space-y-4 sm:space-y-0 sm:flex-row">
                <a href="#">
                    <img class="w-auto h-7" src="https://merakiui.com/images/full-logo.svg" alt="">
                </a>
        
                <p class="text-sm text-gray-600 dark:text-gray-300">© Copyright @php echo date('Y') @endphp. {{__('All rights reserved')}}.</p>
        
                <div class="flex -mx-2">
                    <a href="https://github.com/adriangutierrezd" target="_blank" class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" aria-label="Github">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.026 2C7.13295 1.99937 2.96183 5.54799 2.17842 10.3779C1.395 15.2079 4.23061 19.893 8.87302 21.439C9.37302 21.529 9.55202 21.222 9.55202 20.958C9.55202 20.721 9.54402 20.093 9.54102 19.258C6.76602 19.858 6.18002 17.92 6.18002 17.92C5.99733 17.317 5.60459 16.7993 5.07302 16.461C4.17302 15.842 5.14202 15.856 5.14202 15.856C5.78269 15.9438 6.34657 16.3235 6.66902 16.884C6.94195 17.3803 7.40177 17.747 7.94632 17.9026C8.49087 18.0583 9.07503 17.99 9.56902 17.713C9.61544 17.207 9.84055 16.7341 10.204 16.379C7.99002 16.128 5.66202 15.272 5.66202 11.449C5.64973 10.4602 6.01691 9.5043 6.68802 8.778C6.38437 7.91731 6.42013 6.97325 6.78802 6.138C6.78802 6.138 7.62502 5.869 9.53002 7.159C11.1639 6.71101 12.8882 6.71101 14.522 7.159C16.428 5.868 17.264 6.138 17.264 6.138C17.6336 6.97286 17.6694 7.91757 17.364 8.778C18.0376 9.50423 18.4045 10.4626 18.388 11.453C18.388 15.286 16.058 16.128 13.836 16.375C14.3153 16.8651 14.5612 17.5373 14.511 18.221C14.511 19.555 14.499 20.631 14.499 20.958C14.499 21.225 14.677 21.535 15.186 21.437C19.8265 19.8884 22.6591 15.203 21.874 10.3743C21.089 5.54565 16.9181 1.99888 12.026 2Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </footer>
    </body>
</html>
