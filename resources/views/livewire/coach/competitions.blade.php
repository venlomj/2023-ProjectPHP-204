<div>
    {{-- show preloader while fetching data in the background --}}
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50 animate-pulse"
         wire:loading>
        <x-kmad.preloader class="bg-blue-700/60 text-white border border-lime-700 shadow-2xl">
            {{ $loading }}
        </x-kmad.preloader>

    </div>


    <x-kmad.section
        x-data="{ open: false }"
        class="mb-4 flex gap-2">

        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button wire:click="setNewCompetition()">
                    nieuwe competitie
                </x-button>

            </div>
        </div>


        <div class="flex items-center">
            <div class="flex-1">
                <x-input id="search" type="text" placeholder="Zoek wedstrijd op"
                         wire:model.debounce="search"
                         class="w-full shadow-md placeholder-gray-300" />
            </div>
            <div class="ml-2">
                <x-heroicon-o-information-circle @click="open = !open"
                                                 class="w-5 text-gray-400 cursor-help outline-0" />
            </div>
        </div>
        <x-input-error for="newCompetition" class="mt-4 w-full" />

        <div x-show="open" style="display: none" class="mt-4 bg-sky-50 border-t p-4">
            <x-kmad.list type="ul" class="list-outside mx-4 text-sm">
                <li>Op deze pagina worden alle wedstrijden weergegeven.</li>
                <li>Deze kunnen ook worden aangepast door de coach.</li>
            </x-kmad.list>
        </div>


    </x-kmad.section>
    <div class="my-4">{{ $competitions->links() }}</div>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div style="overflow-x:scroll">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Wedstrijd
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Datum
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        video url
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Locatie
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Land
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Reeksen
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acties
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <div class="my-4">{{ $competitions->links() }}</div>

                @foreach ($competitions as $competition)
                    <tr wire:key="competition_{{ $competition->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $competition->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $competition->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $competition->video_url }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $competition->location_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $competition->country_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button wire:click="showSerie({{ $competition->id }})">
                                INFO
                            </x-button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <x-phosphor-pencil-line-duotone wire:click="setNewCompetition({{ $competition->id }})"
                                                            class=" w-5 text-indigo-600 hover:text-indigo-900 ml-4"/>
                            <x-phosphor-trash-duotone x-data=""
                                                      @click="confirm('Are you sure you want to delete this record?') ? $wire.deleteCompetition({{ $competition->id }}) : ''"
                                                      class=" w-5 text-red-600 hover:text-red-900 ml-4"/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <x-dialog-modal id="competitionModal"
                        wire:model="showModal">
            <x-slot name="title">
                <h2>{{ is_null($newCompetition['id']) ? 'Nieuwe competitie' : 'Aanpassen competitie' }}</h2>
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
                                 wire:model.defer="newCompetition.name"
                                 class="mt-1 block w-full flex-1"/>

                        <x-label for="video_url" value="Video Link" class="mt-4"/>
                        <x-input id="video_url" type="string"
                                 wire:model.defer="newCompetition.video_url"
                                 class="mt-1 block w-full flex-1"/>

                        @if ($newCompetition["id"] > 0)
                            <x-button wire:click="setNewSerie()">
                                nieuwe reeks
                            </x-button>
                        @endif


                    </div>
                    <div class="flex-1 flex flex-col gap-2">
                        <x-label for="date" value="Datum" class="mt-4"/>
                        <x-input id="date" type="date"
                                 wire:model.defer="newCompetition.date"
                                 class="mt-1 block w-full flex-1"/>

                        <x-label for="location_id" value="Locatie" class="mt-4"/>
                        <x-kmad.form.select wire:model.defer="newCompetition.location_id" id="location_id"
                                            class="block mt-1 w-full flex-1">
                            <option value="">Selecteer een locatie</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                            @endforeach
                        </x-kmad.form.select>

                        <x-button wire:click="setNewLocation()">
                            nieuwe locatie
                        </x-button>

                    </div>

                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button @click="show = false">Cancel</x-secondary-button>
                @if(is_null($newCompetition['id']))
                    <x-button
                        wire:click="createCompetition()"
                        wire:loading.attr="disabled"
                        class="ml-2">Opslaan
                    </x-button>
                @else
                    <x-button
                        color="success"
                        wire:click="updateCompetition({{ $newCompetition['id'] }})"
                        wire:loading.attr="disabled"
                        class="ml-2">Update
                    </x-button>
                @endif
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal id="locationModal"
                        wire:model="showModal1">
            <x-slot name="title">
                <h2>Nieuwe locatie</h2>
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

                        <x-label for="country_id" value="Locatie" class="mt-4"/>
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
                @if ($newCompetition["id"] == 0)
                    <x-secondary-button wire:click="setNewCompetition()">Terug</x-secondary-button>
                @else
                    <x-button wire:click="setNewCompetition({{ $competition->id }})">Terug</x-button>
                @endif

                <x-button
                    wire:click="createLocation()"
                    wire:loading.attr="disabled"
                    class="ml-2">Opslaan
                </x-button>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal id="seriesModal"
                        wire:model="showModal2">
            <x-slot name="title">
                <h2>Nieuwe reeks</h2>
                <p>Geselecteerde wedstrijd: {{ $selectedCompetitionName }}</p>
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
                <div class="flex-1 flex flex-col gap-2">
                    <x-label for="distance_id" value="Afstand" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newSerie.distance_id" id="distance_id"
                                        class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een afstand</option>
                        @foreach($distances as $distance)
                            <option value="{{ $distance->id }}">{{ $distance->name }}</option>
                        @endforeach
                    </x-kmad.form.select>

                    <x-label for="stroke_id" value="Slag" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newSerie.stroke_id" id="stroke_id"
                                        class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een slag</option>
                        @foreach($strokes as $stroke)
                            <option value="{{ $stroke->id }}">{{ $stroke->name }}</option>
                        @endforeach
                    </x-kmad.form.select>

                    <x-label for="sex_id" value="Geslacht" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newSerie.sex_id" id="sex_id"
                                        class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een geslacht</option>
                        @foreach($sexes as $sex)
                            <option value="{{ $sex->id }}">{{ $sex->name }}</option>
                        @endforeach
                    </x-kmad.form.select>
                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <x-label for="start_time" value="Start tijd" class="mt-4"/>
                    <x-input id="start_time" type="time"
                             wire:model.defer="newSerie.start_time"
                             class="mt-1 block w-full flex-1"/>

                    <x-label for="follow_number" value="Volgnummer" class="mt-4"/>
                    <x-input id="follow_number" type="number"
                             wire:model.defer="newSerie.follow_number"
                             class="mt-1 block w-full flex-1"/>
                </div>
            </x-slot>
            <x-slot name="footer">

                @if ($newCompetition["id"] == 0)
                    <x-secondary-button wire:click="setNewCompetition()">Terug</x-secondary-button>
                @else
                    <x-button wire:click="setNewCompetition({{ $competition->id }})">Terug</x-button>
                @endif
                <x-button
                    wire:click="createSerie()"
                    wire:loading.attr="disabled"
                    class="ml-2">Opslaan
                </x-button>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal id="seriesModal"
                        wire:model="showModal3">
            <x-slot name="title">
                Reeksen voor {{ $competition->name }}
            </x-slot>

            <x-slot name="content">
                <div class="flex flex-row gap-4 mt-4">
                    <ul>
                        @foreach($series as $serie)
                            <li>{{ $serie->distance->name }} {{ $serie->stroke->name }} {{ $serie->sex->name }}</li>

                        @endforeach
                    </ul>

                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button @click="show = false">Cancel</x-secondary-button>
            </x-slot>
        </x-dialog-modal>

        <x-dialog-modal id="countryModal"
                        wire:model="showModal4">
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
    <div class="my-4">{{ $competitions->links() }}</div>
    {{-- No records found --}}
    @if($competitions->isEmpty())
        <x-kmad.alert type="danger" class="w-full">
            Can't find any artist or album with <b>'{{ $name }}'</b> for this genre
        </x-kmad.alert>
    @endif
</div>
