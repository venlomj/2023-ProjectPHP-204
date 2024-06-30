<div>

    <x-kmad.section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">

        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button wire:click="setNewTraining()">
                    Nieuwe training
                </x-button>

            </div>

            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newTraining" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-kmad.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Op deze pagina kan de coach trainingen beheren.
                </li>

            </x-kmad.list>
        </div>
    </x-kmad.section>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div style="overflow-x:scroll"></div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zwemmer</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TrainingsType</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Begintijd</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Eindtijd</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Locatie</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <div class="my-4">{{ $training->links() }}</div>
            @foreach ($training as $train)
                <tr wire:key="$training{{ $train->id }}">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $train->swimmer_name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $train->trainings_type_name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $train->start_time}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $train->end_time}}</td>
                    {{--<td class="px-6 py-4 whitespace-nowrap">{{ $train->is_sent}}</td>--}}
                   {{-- <td class="px-6 py-4 whitespace-nowrap">{{ $train->id }}</td>--}}
                  <td class="px-6 py-4 whitespace-nowrap">{{ $train->location_name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <x-phosphor-pencil-line-duotone wire:click="setNewTraining({{ $train->id }})"
                                                        class=" w-5 text-indigo-600 hover:text-indigo-900 ml-4"/>
                        <x-phosphor-trash-duotone  x-data=""
                                                   @click="confirm('Are you sure you want to delete this training?') ? $wire.deleteTraining({{ $train->id }}) : ''"
                                                   class=" w-5 text-red-600 hover:text-red-900 ml-4"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    <x-dialog-modal id="trainingModal"
                    wire:model="showModal">
        <x-slot name="title">
            <h2>{{ is_null($newTraining['id']) ? 'Nieuwe training' : 'Aanpassen training' }}</h2>
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
                    <x-label for="user_id" value="User" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newTraining.user_id" id="user_id" class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een Zwemmer</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->user_name}}</option>
                        @endforeach
                    </x-kmad.form.select>
                </div>

                <div class="flex-1 flex flex-col gap-2">
                    <x-label for="trainings_type_id" value="TrainingsType" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newTraining.training_type_id" id="training_type_id" class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een trainingstype</option>
                        @foreach($trainingsTypes as $trainingsType)
                            <option value="{{ $trainingsType->id }}">{{ $trainingsType->name}}</option>
                        @endforeach
                    </x-kmad.form.select>
                </div>


                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <x-label for="date" value="Start tijd" class="mt-4"/>
                    <x-input id="date" type="datetime-local"
                             wire:model.defer="newTraining.start_time"
                             class="mt-1 block w-full flex-1"/>
                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <x-label for="date" value="Eind tijd" class="mt-4"/>
                    <x-input id="date" type="datetime-local"
                             wire:model.defer="newTraining.end_time"
                             class="mt-1 block w-full flex-1"/>
                </div>
                <div class="flex-1 flex flex-col gap-2">
                    <x-label for="location_id" value="Locatie" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newTraining.location_id" id="location_id" class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een locatie</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </x-kmad.form.select>

                </div>

        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="show = false">Cancel</x-secondary-button>
            @if(is_null($newTraining['id']))
                <x-button
                    wire:click="createTraining()"
                    wire:loading.attr="disabled"
                    class="ml-2">Opslaan
                </x-button>
            @else
                <x-button
                    color="success"
                    wire:click="updateTraining({{ $newTraining['id'] }})"
                    wire:loading.attr="disabled"
                    class="ml-2">Update
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
