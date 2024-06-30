<x-zwemclub-layout>
    <x-slot name="description">Contact info</x-slot>
    <x-slot name="title">Contact info</x-slot>

    <div class="grid grid-cols-4 gap-4">
        <x-kmad.section class="col-span-4 lg:col-span-3 lg:order-2">
            {{-- embed the Livewire ContactForm component --}}
            @livewire('admin.contact-form')
        </x-kmad.section>
        <section class="col-span-4 lg:col-span-1 lg:order-1">
            <h3>BRABO Antwerpen</h3>
            <p>Noorderlaan 21</p>
            <p class="pb-2 border-b">2030 Antwerpen - Belgium</p>
            <p class="flex items-center pt-2 cursor-pointer">
                <x-phosphor-phone-call class="w-6 mr-2 text-gray-400"/>
                <a href="tel:+3214562310" class="mr-2">+32(0)14/56.23.10</a>
            </p>
            <p class="flex items-center pt-2 cursor-pointer">
                <x-phosphor-envelope class="w-6 mr-2 text-gray-400"/>
                <a href="mailto:info@thevinylshop.com">info@kmad.com</a>
            </p>
        </section>
    </div>
</x-zwemclub-layout>
