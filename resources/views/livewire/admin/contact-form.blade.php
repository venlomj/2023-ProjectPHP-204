<form wire:submit.prevent="sendEmail">
    <x-kmad.errorbag />
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-2 md:col-span-1">
            <x-label for="name" value="Name"/>
            <x-input type="text" id="name" name="name" placeholder="Your name"
                         wire:model.lazy="name"
                         class="block mt-1 w-full"/>
            <x-input-error for="name" class="mt-2"/>
        </div>
        <div class="col-span-2 md:col-span-1">
            <x-label for="email" value="Email"/>
            <x-input type="email" id="email" name="email" placeholder="Your email"
                         wire:model.lazy="email"
                         class="block mt-1 w-full"/>
            <x-input-error for="email" class="mt-2"/>
        </div>
        <div class="col-span-2">
            <x-label for="message" value="Message"/>
            <x-kmad.form.textarea id="message" name="message" rows="5" placeholder="Your message"
                                 wire:model.lazy="message"
                                 class="block mt-1 w-full">
            </x-kmad.form.textarea>
            <x-input-error for="message" class="mt-2"/>
        </div>
        <div class="col-span-2">
            <x-button disabled="{{ !$can_submit }}" class="col-span-2">verzend bericht</x-button>
        </div>
    </div>
</form>

