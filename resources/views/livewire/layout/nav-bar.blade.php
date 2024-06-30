<button type="button" class="block lg:hidden" id="mobile-menu">
    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>
<nav id="navigation" class="hidden lg:block">
    <div class="container mx-auto p-4 lg:flex lg:flex-row items-center lg:justify-between">
        {{-- left navigation--}}
        <div class="lg:flex items-center space-x-2">
            {{-- Logo --}}
            <a href="{{ route('home') }}">
                <div>KMA-D</div>
            </a>
            <a class="hidden sm:block font-medium text-lg" href="{{ route('home') }}">
                Zwemclub Antwerpen
            </a>
            <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                Contact
            </x-nav-link>
            @auth()
                <x-nav-link href="{{ route('calendar') }}" :active="request()->routeIs('calendar')">
                    Kalender
                </x-nav-link>

                <div class="lg:grid lg:grid-cols-5">
                    <x-dropdown class="col-span-1" align="left" width="48">
                        {{-- avatar --}}
                        <x-slot name="trigger">
                            <div class="grid grid-cols-7">
                                <p class="col-span-5 lg:text-right items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300"
                                   :active="request()->routeIs('contact')">
                                    Wedstrijden
                                </p>
                                <svg class="col-span-1 mt-auto -mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            {{-- all users --}}
                            <x-dropdown-link href="{{ route('competition-stats') }}">Wedstrijdprestaties raadplegen
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('view-competitions') }}">Wedstrijdenoverzicht
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('competitions') }}">Wedstrijden beheren</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    @auth
                        @if(auth()->user()->is_coach)
                            <x-dropdown class="col-span-1" align="left" width="48">
                                {{-- avatar --}}
                                <x-slot name="trigger">
                                    <div class="grid grid-cols-7">
                                        <p class="col-span-5 lg:text-right items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300"
                                           :active="request()->routeIs('contact')">
                                            Coach
                                        </p>
                                        <svg class="col-span-1 mt-auto -mr-1 ml-2 h-5 w-5"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    {{-- all users --}}

                                    <x-dropdown-link href="{{ route('supplements') }}">Supplementen beheren
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('give-supplements') }}">Supplementen toewijzen
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('trainings') }}">Training beheren</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('trainingsType') }}">Trainingstype beheren
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('locations') }}">Locaties beheren</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('competition-stats') }}">Wedstrijdprestaties
                                        ingeven
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    @endauth
                    @auth
                        @if(auth()->user()->is_financial_administrator)
                            <x-dropdown class="col-span-1" align="left" width="48">
                                {{-- avatar --}}
                                <x-slot name="trigger">
                                    <div class="grid grid-cols-7">
                                        <p class="col-span-5 lg:text-right items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300"
                                           :active="request()->routeIs('contact')">
                                            Financieel
                                        </p>
                                        <svg class="col-span-1 mt-auto -mr-1 ml-2 h-5 w-5"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    {{-- all users --}}

                                    <x-dropdown-link href="{{ route('distribution-documents') }}">Verdeeldocument
                                        raadplegen
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('products') }}">Product beheren</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('order-documents') }}">Besteldocument raadplegen
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    @endauth
                    @auth
                        @if(auth()->user()->is_admin)
                            <x-dropdown class="col-span-1" align="left" width="48">
                                {{-- avatar --}}
                                <x-slot name="trigger">
                                    <div class="grid grid-cols-7">
                                        <p class="col-span-5 lg:text-right items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300"
                                           :active="request()->routeIs('contact')">
                                            Admin
                                        </p>
                                        <svg class="col-span-1 mt-auto -mr-1 ml-2 h-5 w-5"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('users') }}">Gebruikers beheren</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('genders') }}">Geslacht beheren</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('strokes') }}">Slag beheren</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('distances') }}">Afstand beheren</x-dropdown-link>
                                    <x-dropdown-link href="{{ route('parameters') }}">Parameters beheren
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    @endauth
                </div>
        </div>

        @endauth


        {{-- right navigation --}}
        <div class="relative flex items-center space-x-2">
            @guest
                <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    Login
                </x-nav-link>
                <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    Registreer
                </x-nav-link>
            @endguest
            {{-- dropdown navigation--}}
            @auth
                <x-dropdown align="right" width="48">
                    {{-- avatar --}}
                    <x-slot name="trigger">
                        <img class="rounded-full h-8 w-8 cursor-pointer"
                             src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                             alt="{{ auth()->user()->name }}">

                    </x-slot>
                    <x-slot name="content">
                        {{-- all users --}}
                        <div class="block px-4 py-2 text-xs text-gray-400">{{ auth()->user()->full_name }}</div>
                        <x-dropdown-link href="{{ route('dashboard') }}">Dashboard</x-dropdown-link>
                        <x-dropdown-link href="https://drive.google.com/file/d/16qRQdlQm5KG4M3jbLWBp0hDhxjRXZrCe/view?usp=sharing" download target="_blank">Hulp nodig?</x-dropdown-link>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                                Afmelden
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth
        </div>
    </div>
</nav>
<script>
    const button = document.getElementById('mobile-menu');
    const navigation = document.getElementById('navigation');
    button.addEventListener('click', () => {
        navigation.classList.toggle('hidden');
    });
</script>
