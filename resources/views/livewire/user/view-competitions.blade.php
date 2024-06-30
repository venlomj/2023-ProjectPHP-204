<div x-data="{ show: false }">
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50 animate-pulse"
         wire:loading>
        <x-kmad.preloader class="bg-blue-700/60 text-white border border-lime-700 shadow-2xl">
            {{ $loading }}
        </x-kmad.preloader>

    </div>


    <div x-show="!show">
        <div class="relative w-64 mb-4">
            @auth()
                @if(auth()->user()->is_swimmer)
                    <x-button wire:click="registrationCompetition()">
                        Inschrijven voor een wedstrijd
                    </x-button>
                @endif
            @endauth
            @auth()
                @if(auth()->user()->is_coach)
                    <x-button @click="show = true" x-show="!show">
                        Overzicht te controleren wedstrijden
                    </x-button>
                @endif
            @endauth

        </div>
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
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($competitions as $competition)
                        <tr wire:key="competition_{{ $competition->id }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $competition->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $competition->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $competition->video_url }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $competition->location_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $competition->country_name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- app/Http/Livewire/Register.php -->
                <div>
                    <!-- First Modal - Select Competition -->
                    <x-dialog-modal wire:model="showModal">
                        <x-slot name="title">
                            <h2>Nieuwe inschrijving: {{ auth()->user()->user_name }}</h2>
                        </x-slot>

                        <x-slot name="content">
                            <x-label for="competition" value="Wedstrijd" class="mt-4"/>
                            <x-kmad.form.select id="competition" wire:model="selectedCompetition"
                                                wire:init="setDefaultCompetition">
                                @foreach($competitions as $competition)
                                    <option value="{{ $competition->id }}">{{ $competition->name }}</option>
                                @endforeach
                            </x-kmad.form.select>
                        </x-slot>

                        <x-slot name="footer">
                            <x-secondary-button @click="show = false">Terug</x-secondary-button>
                            <x-button wire:click="openSecondModal">Selecteer reeksen</x-button>
                        </x-slot>
                    </x-dialog-modal>

                    <!-- Second Modal - Select Serie -->
                    <x-dialog-modal wire:model="showSecondModal">
                        <x-slot name="title">
                            <h2>Selecteer reeksen</h2>
                            <h1>{{ $selectedCompetitionName }} {{ $selectedCompetitionDate }}</h1>
                            <h1>{{ auth()->user()->user_name }}</h1>
                        </x-slot>

                        <x-slot name="content">

                            <div class="space-y-2">
                                @foreach($series as $serie)
                                    <label for="serie{{ $serie->id }}" class="flex items-center">
                                        <input type="checkbox" id="serie_{{ $serie->id }}" value="{{ $serie->id }}"
                                               wire:model="selectedSeries.{{ $loop->index }}" class="form-checkbox">
                                        <span
                                            class="ml-2">{{ $serie->stroke->name }} {{ $serie->distance->name }} {{ $serie->start_time }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-secondary-button wire:click="registrationCompetition()">Terug</x-secondary-button>
                            <x-button wire:click="saveRegistration">Opslaan</x-button>
                        </x-slot>
                    </x-dialog-modal>
                </div>

        </div>
    </div>

    <div x-show="show">
        <x-button @click="show = false" x-show="show">
            Wedstrijden bekijken
        </x-button>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Bevestigd
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Zwemmer
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Wedstrijd (datum)
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Inschrijven
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($groupBySeries as $group)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $group->status->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $group->user->user_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $group->series->contest->name }} {{ $group->series->contest->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-button wire:click="showUserSeries({{ $group->id }})">
                                Show Selected Choices
                            </x-button>
                        </td>


                    </tr>
                @endforeach
                </tbody>


            </table>

            <x-dialog-modal id="seriesModal"
                            wire:model="showThirdModal">
                <x-slot name="title">

                    <p>User: {{ $selectedUsername }}</p>
                </x-slot>

                <x-slot name="content">
                    <div class="flex flex-row gap-4 mt-4">
                        @foreach ($series as $serie)
                            @php
                                // Check if the UserSeries with matching properties exists
                                $userSeries = $group->where('series_id', $serie->id)
                                                    ->where('user_id', $selectedUserId)
                                                    ->where('status_id', $selectedStatusId)
                                                    ->first();
                            @endphp

                            @if ($userSeries)
                                <li>{{ $serie->distance->name }} {{ $serie->stroke->name }} {{ $serie->sex->name }}</li>
                            @endif
                        @endforeach
                    </div>
                </x-slot>


                <x-slot name="footer">
                    <x-secondary-button @click="show = false">Terug</x-secondary-button>
                    <x-button wire:click="validateRegistration()">
                        Keur registratie goed
                    </x-button>
                </x-slot>
            </x-dialog-modal>
        </div>
    </div>


</div>
