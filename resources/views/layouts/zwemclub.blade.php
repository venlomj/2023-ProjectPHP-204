<!doctype html>
<html lang="nl">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welkom bij zwemclub Antwerpen">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Zwemclub Antwerpen: {{ $title ?? '' }}</title>
    @livewireStyles
</head>
<body class="font-sans antialiased">
<div class="flex flex-col space-y-4 min-h-screen text-gray-800 bg-gray-100">
    <header class="shadow bg-white/70 sticky inset-0 backdrop-blur-sm z-10">
        {{--          Navigation--}}
{{--        <x-layout.nav/>--}}
        @livewire('layout.nav-bar')
    </header>
    <main class="container mx-auto p-4 flex-1 px-4">
        {{--         Title--}}
        <h1 class="text-3xl mb-4">
            {{ $title ?? '' }}
        </h1>
        {{--         Main content--}}
        {{ $slot ?? ''}}
    </main>
    <x-layout.footer/>
</div>
@stack('script')
@livewireScripts
</body>
</html>
