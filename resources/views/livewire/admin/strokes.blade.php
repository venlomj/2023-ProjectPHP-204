<div>

    <x-kmad.section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">

        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button wire:click="setNewStroke()">
                    Nieuwe slag
                </x-button>

            </div>

            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newStroke" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-kmad.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Op deze pagina kan de admin de slagen beheren
                </li>

            </x-kmad.list>
        </div>
    </x-kmad.section>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div style="overflow-x:scroll">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slag</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <div class="my-4">{{ $strokes->links() }}</div>
            @foreach ($strokes as $stroke)
                <tr wire:key="$stroke{{ $stroke->id }}">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $stroke->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <x-phosphor-pencil-line-duotone class="outline-0"
                                                        data-tippy-content="Aanpassen" wire:click="setNewStroke({{ $stroke->id }})"
                                                        class=" w-5 text-indigo-600 hover:text-indigo-900 ml-4"/>
                        <x-phosphor-trash-duotone  class="outline-0"
                                                   data-tippy-content="Verwijderen" x-data=""
                                                   @click="confirm('Bent u zeker dat u deze slag wilt verwijderen?') ? $wire.deleteStroke({{ $stroke->id }}) : ''"
                                                   class=" w-5 text-red-600 hover:text-red-900 ml-4"/>
                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    <x-dialog-modal id="strokeModal"
                    wire:model="showModal">
        <x-slot name="title">
            <h2>{{ is_null($newStroke['id']) ? 'Nieuwe slag' : 'Aanpassen slag' }}</h2>
        </x-slot>

        <x-slot name="content">
            @if ($errors->any())
                <x-kmad.alert type="danger">
                    <x-kmad.list>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </x-kmad.list>
                </x-kmad.alert>
            @endif
            <div class="flex flex-row gap-4 mt-4">
                <div class="flex-1 flex flex-col gap-2">
                    <x-label for="name" value="Naam" class="mt-4"/>
                    <x-input id="name" type="string"
                             wire:model.defer="newStroke.name"
                             class="mt-1 block w-full flex-1"/>

                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="show = false">Cancel</x-secondary-button>
            @if(is_null($newStroke['id']))
                <x-button
                    wire:click="createStroke()"
                    wire:loading.attr="disabled"
                    class="ml-2">Opslaan
                </x-button>
            @else
                <x-button
                    color="success"
                    wire:click="updateStroke({{ $newStroke['id'] }})"
                    wire:loading.attr="disabled"
                    class="ml-2">Update
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
