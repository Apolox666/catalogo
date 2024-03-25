<header class="bg-gray-100 h-20 shadow-md fixed w-full z-50">
    <nav class="flex mx-auto max-w-[1200px] w-[90%] overflow-hidden items-center h-full justify-between">
        <a href="">
            <img src="{{ asset('images/logoti.png') }}" alt="" width="190px">
        </a>

        <ul class="flex gap-8 font-bold text-lg">
            <li>
                <a class="hover:text-blue-600 hidden md:flex" href="">Inicio</a>
            </li>
            <li>
                <a class="hover:text-blue-600 hidden md:flex" href="http://localhost/catalogo/public/#que_es">Que es
                    MSU Assist</a>
            </li>
            @if (Route::has('login'))
                <li>
                    @auth
                        <a class="text-white py-2 px-6 bg-blue-600 rounded-full hover:bg-blue-400 shadow-lg"
                            href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white py-2 px-6 bg-blue-600 rounded-full hover:bg-blue-400 shadow-lg"
                        wire:navigate>Login</a>
                @endauth
            @endif
        </ul>
    </nav>
</header>