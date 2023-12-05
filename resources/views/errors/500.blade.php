<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Error')}}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script>
        if (
          localStorage.getItem('color-theme') === 'dark' ||
          (!('color-theme' in localStorage) &&
            window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <main class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <p class="text-base font-semibold text-blue-600">500</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{__('An error ocurred')}}</h1>
            <p class="mt-6 text-base leading-7 text-gray-600">{{__('It seems that a server-side error has occurred, sorry for the inconvenience')}}</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
              <a href="{{route('dashboard')}}" 
                class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold
                text-white shadow-sm hover:bg-blue-500 focus-visible:outline
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{__('Go back home')}}</a>
            </div>
          </div>
    </main>
</body>
</html>