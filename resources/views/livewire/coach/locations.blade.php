<div>

    <x-kmad.section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">

        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button wire:click="setNewLocation()">
                    Nieuwe Locatie
                </x-button>

            </div>

            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newLocation" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-kmad.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Op deze pagina kunnen de verschillende locaties worden beheerd door de coach.
                </li>

            </x-kmad.list>
        </div>
    </x-kmad.section>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div style="overflow-x:scroll">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Naam
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    locatie
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    land
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acties
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <div class="my-4">{{ $locations->links() }}</div>
            @foreach ($locations as $location)
                <tr wire:key="location_{{ $location->id }}">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $location->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $location->location_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $location->country->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <x-phosphor-pencil-line-duotone class="outline-0"
                                                        data-tippy-content="Aanpassen" wire:click="setNewLocation({{ $location->id }})"
                                                        class=" w-5 text-indigo-600 hover:text-indigo-900 ml-4"/>
                        <x-phosphor-trash-duotone class="outline-0"
                                                  data-tippy-content="Verwijderen" x-data=""
                                                  @click="confirm('Bent u zeker dat u deze locatie wilt verwijderen') ? $wire.deleteLocation({{ $location->id }}) : ''"
                                                  class=" w-5 text-red-600 hover:text-red-900 ml-4"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <x-dialog-modal id="locationModal"
                    wire:model="showModal">
        <x-slot name="title">
            <h2>{{ is_null($newLocation['id']) ? 'Nieuwe locatie' : 'Aanpassen locatie' }}</h2>
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
                             wire:model.defer="newLocation.name"
                             class="mt-1 block w-full flex-1"/>

                    <x-label for="street" value="Straat" class="mt-4"/>
                    <x-input id="street" type="string"
                             wire:model.defer="newLocation.street"
                             class="mt-1 block w-full flex-1"/>

                    <x-label for="street_number" value="Straatnummer" class="mt-4"/>
                    <x-input id="street_number" type="number"
                             wire:model.defer="newLocation.street_number"
                             class="mt-1 block w-full flex-1"/>


                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <x-label for="city" value="Stad" class="mt-4"/>
                    <x-input id="city" type="string"
                             wire:model.defer="newLocation.city"
                             class="mt-1 block w-full flex-1"/>


                    <x-label for="postal_code" value="Postcode" class="mt-4"/>
                    <x-input id="postal_code" type="number"
                             wire:model.defer="newLocation.postal_code"
                             class="mt-1 block w-full flex-1"/>

                    <x-label for="country_id" value="Land" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newLocation.country_id" id="country_id"
                                        class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een locatie</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </x-kmad.form.select>
                    <x-button wire:click="setNewCountry()">
                        nieuw land
                    </x-button>


                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="show = false">Cancel</x-secondary-button>
            @if(is_null($newLocation['id']))
                <x-button
                    wire:click="createLocation()"
                    wire:loading.attr="disabled"
                    class="ml-2">Opslaan
                </x-button>
            @else
                <x-button
                    color="success"
                    wire:click="updateLocation({{ $newLocation['id'] }})"
                    wire:loading.attr="disabled"
                    class="ml-2">Update
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal id="countryModal"
                    wire:model="showModal1">
        <x-slot name="title">
            <h2>Nieuw land</h2>
        </x-slot>

        <x-slot name="content">

                <x-label for="name" value="Naam" class="mt-4"/>
                <x-input id="name" type="string"
                         wire:model.defer="newCountry.name"
                         class="mt-1 block w-full flex-1"/>

        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="setNewLocation()">Terug</x-secondary-button>
            <x-button
                wire:click="createCountry()"
                wire:loading.attr="disabled"
                class="ml-2">Opslaan
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
