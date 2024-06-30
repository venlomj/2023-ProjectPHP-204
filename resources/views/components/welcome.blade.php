
    <!-- Hero Section -->
    <section id="banner" class="py-20 text-white">
        <div class="container mx-auto text-center">
            <h1 id="text-shadow-h1" class="text-4xl font-bold mb-4">Welkom bij zwemclub Antwerpen</h1>
            <p class="text-lg mb-8">BRABO is competitiezwemmen op het allerhoogste niveau, van onze thuisbasis Antwerpen tot op de Olympische Spelen.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Ontdek meer over ons</h2>
            <div class="flex justify-center">
                <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-5">

                    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow col-span-1">
                        <a href="{{ route('strokes') }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Zwemmers</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">Vind hier een lijst van onze ingeschreven zwemmers.</p>
                        <a href="{{ route('supplements') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Ga verder
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>

                    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow col-span-1">
                        <a href="{{ route('view-competitions') }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Wedstrijdoverzicht</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">Vind hier een lijst van komende wedstrijden in onze club.</p>
                        <a href="{{ route('view-competitions') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Ga verder
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>


                    <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow col-span-1">
                        <a href="{{ route('supplements') }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Coaches</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">Vind hier een lijst van onze ingeschreven coaches.</p>
                        <a href="{{ route('supplements') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Ga verder
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

