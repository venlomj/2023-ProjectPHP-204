<div>

    <x-kmad.section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">

        <div class="p-4 flex justify-between items-start gap-4">
            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newStat" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-kmad.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Op deze pagina kunnen de wedstrijdprestaties worden beheerd voor elke zwemmer door hun coach.
                </li>

            </x-kmad.list>
        </div>
    </x-kmad.section>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div style="overflow-x:scroll">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wedstrijd
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Zwemmer(federatienummer)
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Datum
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">INFO
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($userseries as $userserie)
                    <tr wire:key="userserie_{{ $userserie->id }}">

                        <td class="px-6 py-4 whitespace-nowrap">{{ $userserie->series->contest->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$userserie->user->first_name}} {{$userserie->user->last_name}}
                            ( {{ $userserie->user->federation_number }} )
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $userserie->series->contest->date}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <x-phosphor-pencil-line-duotone class="outline-0"
                                                            data-tippy-content="Aanpassen"
                                                            wire:click="setNewStat({{ $userserie->id }})"
                                                            class=" w-5 text-indigo-600 hover:text-indigo-900 ml-4"/>
                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <x-dialog-modal id="statModal"
                        wire:model="showModal">
            <x-slot name="title">
                <h2>{{ is_null($newStat['id']) ? 'Wedstrijdprestaties ingeven' : 'Aanpassen wedstrijdprestaties' }}</h2>
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
                        <x-label class=" py-4 whitespace-nowrap " value="{{ $selectedCompetitionStat }}"/>
                        <x-label class=" py-4 whitespace-nowrap "
                                 value="Zwemmer: {{ $selectedCompetitionStatUserName }} {{ $userserie->series->contest->date  }}"/>


                        @if ($showModal)
                            @foreach ($userseries as $userserie)
                                @if ($userserie->id == $selectedUserSerieId)
                                    @foreach ($series as $serie)
                                        @if ($serie->id == $userserie->series_id)
                                            <li>{{ $serie->distance->name }} {{ $serie->stroke->name }} in seconden
                                                (s)
                                            </li>
                                            <input type="text" id="time_travelled" class="form-control"
                                                   wire:model.defer="time_travelled"
                                                   class="mt-1 block w-full flex-1"/>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif

                    </div>

                </div>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button @click="show = false">Cancel</x-secondary-button>
                @if(is_null($selectedUserSerieId))
                    <x-button
                        wire:click="createStat()"
                        wire:loading.attr="disabled"
                        class="ml-2">Opslaan
                    </x-button>
                @else
                    <x-button
                        color="success"
                        wire:click="updateStat({{ $selectedUserSerieId }})"
                        wire:loading.attr="disabled"
                        class="ml-2">Update
                    </x-button>
                @endif
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
