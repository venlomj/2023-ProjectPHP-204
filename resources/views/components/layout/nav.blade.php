{{--<nav class="container mx-auto p-4 flex justify-between items-center">--}}
{{--    <a class="underline">Home</a>--}}
{{--    <a class="underline">Contact</a>--}}
{{--    <a  class="underline">Lid</a>--}}
{{--</nav>--}}

{{--<nav class="container mx-auto p-4 flex justify-between">--}}
{{--    --}}{{-- left navigation--}}
{{--    <div class="flex items-center space-x-2">--}}
{{--        --}}{{-- Logo --}}
{{--        <a href="{{ route('home') }}">--}}
{{--            <div>KMA-D</div>--}}
{{--        </a>--}}
{{--        <a class="hidden sm:block font-medium text-lg" href="{{ route('home') }}">--}}
{{--            Zwemclub Antwerpen--}}
{{--        </a>--}}
{{--        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('shop')">--}}
{{--            Club--}}
{{--        </x-nav-link>--}}
{{--        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('contact')">--}}
{{--            Zwemmer--}}
{{--        </x-nav-link>--}}


{{--        <x-dropdown align="left" width="48">--}}
{{--            --}}{{-- avatar --}}
{{--            <x-slot name="trigger">--}}
{{--                <div class="grid grid-cols-6">--}}
{{--                <x-nav-link class="grid-cols-5" :active="request()->routeIs('contact')">--}}
{{--                    Wedstrijden--}}
{{--                    <svg class="grid-cols-1 -mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                    </svg>--}}
{{--                </x-nav-link>--}}
{{--                </div>--}}
{{--            </x-slot>--}}
{{--            <x-slot name="content">--}}
{{--                --}}{{-- all users --}}

{{--                <x-dropdown-link href="{{ route('home') }}">Inschrijven wedstrijd</x-dropdown-link>--}}
{{--                <x-dropdown-link href="{{ route('home') }}">Wedstrijdoverzicht tonen</x-dropdown-link>--}}
{{--                <x-dropdown-link href="{{ route('home') }}">Wedstrijdprestaties raadplegen</x-dropdown-link>--}}
{{--                <x-dropdown-link href="{{ route('home') }}">Wedstrijden beheren</x-dropdown-link>--}}
{{--            </x-slot>--}}
{{--        </x-dropdown>--}}
{{--    </div>--}}

{{--    --}}{{-- right navigation --}}
{{--    <div class="relative flex items-center space-x-2">--}}
{{--        @guest--}}
{{--        <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">--}}
{{--            Login--}}
{{--        </x-nav-link>--}}
{{--        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">--}}
{{--            Registreer--}}
{{--        </x-nav-link>--}}
{{--        @endguest--}}
{{--        --}}{{-- dropdown navigation--}}
{{--            @auth--}}
{{--        <x-dropdown align="right" width="48">--}}
{{--            --}}{{-- avatar --}}
{{--            <x-slot name="trigger">--}}
{{--                <img class="rounded-full h-8 w-8 cursor-pointer"--}}
{{--                     src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->full_name)}}"--}}
{{--                     alt="{{ auth()->user()->full_name }}">--}}
{{--            </x-slot>--}}
{{--            <x-slot name="content">--}}
{{--                --}}{{-- all users --}}
{{--                <div class="block px-4 py-2 text-xs text-gray-400">{{ auth()->user()->full_name }}</div>--}}
{{--                <x-dropdown-link href="{{ route('dashboard') }}">Dashboard</x-dropdown-link>--}}
{{--                <x-dropdown-link href="{{ route('profile.show') }}">Profiel bijwerken</x-dropdown-link>--}}
{{--                <div class="border-t border-gray-100"></div>--}}
{{--                <form method="POST" action="{{ route('logout') }}">--}}
{{--                    @csrf--}}
{{--                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">Afmelden</button>--}}
{{--                </form>--}}
{{--                @if(auth()->user()->is_admin)--}}
{{--                <div class="border-t border-gray-100"></div>--}}
{{--                --}}{{-- admins only --}}
{{--                <div class="block px-4 py-2 text-xs text-gray-400">Admin</div>--}}
{{--                <x-dropdown-link href="{{ route('admin.users') }}">Personeel beheren</x-dropdown-link>--}}
{{--                <x-dropdown-link href="{{ route('home') }}">Zwemmer</x-dropdown-link>--}}
{{--                <x-dropdown-link href="{{ route('home') }}">Club</x-dropdown-link>--}}
{{--                <x-dropdown-link href="{{ route('home') }}">Coach</x-dropdown-link>--}}
{{--                <x-dropdown-link href="{{ route('home') }}">Orders</x-dropdown-link>--}}
{{--                @endif--}}
{{--            </x-slot>--}}
{{--        </x-dropdown>--}}
{{--            @endauth--}}
{{--    </div>--}}
{{--</nav>--}}



