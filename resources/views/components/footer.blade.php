<footer class="bg-blueGray-800">
    <div class="container">

        <div class="flex flex-col sm:flex-row justify-between py-8 px-2 items-start  sm:items-center">
            {{-- Logo --}}
            <a class="flex-shrink-0 flex items-center py-5 sm:py-0" href="/">
                <img class="block lg:hidden h-8 w-auto"
                            src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                <img class="hidden lg:block h-8 w-auto"
                            src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                            alt="Workflow">
            </a>
            {{-- App links --}}
            <div class="flex flex-col text-white py-5 sm:py-0">
                <a href="/" class="hover:underline">Inicio</a>
                <a href="{{ route('workouts.index') }}" class="hover:underline">Plataforma</a>
            </div>

            {{-- Legal Links --}}
            <div class="flex flex-col text-white py-5 sm:py-0">
                <a href="{{route('politica-de-cookies.show')}}" class="hover:underline">Política de cookies</a>
                <a href="{{route('politica-de-privacidad.show')}}" class="hover:underline">Política de privacidad</a>
                <a href="{{route('aviso-legal.show')}}" class="hover:underline">Aviso Legal</a>
            </div>
        </div>






        <p class="text-sm text-white text-center">Desarrollado por <a href="https://adriangutierrezd.com" target="_blank" class="hover:underline">Adrián Gutiérrez</a> &copy; <?php echo(date('Y')) ?></p>
    </div>
</footer>