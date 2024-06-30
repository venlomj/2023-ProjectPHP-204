<div>

    <x-kmad.section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">

        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button wire:click="setNewUserSupplement()">
                    Nieuw supplement
                </x-button>

            </div>

            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newSwimmerSupplement" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-kmad.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Op deze pagina kan de coach supplementen toewijzen aan de zwemmers.
                </li>

            </x-kmad.list>
        </div>
    </x-kmad.section>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zwemmer</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplement</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Innametijd</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hoeveelheid</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <div class="my-4">{{ $usersupplements->links() }}</div>
            @foreach ($usersupplements as $usersupplement)
                <tr wire:key="usersupplement_{{ $usersupplement->id }}">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $usersupplement->user->first_name }} {{ $usersupplement->user->last_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $usersupplement->supplement->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $usersupplement->supplement_schedule }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $usersupplement->amount }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <x-phosphor-pencil-line-duotone class="outline-0"
                                                        data-tippy-content="Aanpassen" wire:click="setNewUserSupplement({{ $usersupplement->id }})"
                                                        class=" w-5 text-indigo-600 hover:text-indigo-900 ml-4"/>
                        <x-phosphor-trash-duotone class="outline-0"
                                                  data-tippy-content="Verwijderen" x-data=""
                                                   @click="confirm('Bent u zeker dat u deze zwemmer en supplementen wilt verwijderen?') ? $wire.deleteNewUserSupplement({{ $usersupplement->id }}) : ''"
                                                   class=" w-5 text-red-600 hover:text-red-900 ml-4"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    <x-dialog-modal id="supplementModal"
                    wire:model="showModal">
        <x-slot name="title">
            <h2>{{ is_null($newSwimmerSupplement['id']) ? 'Nieuw supplement' : 'Aanpassen supplement' }}</h2>
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
                        <x-label for="user_id" value="Zwemmer" class="mt-4"/>
                        <x-kmad.form.select wire:model.defer="newSwimmerSupplement.user_id" id="user_id"
                                            class="block mt-1 w-full flex-1">
                            <option value="">Selecteer een zwemmer</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                            @endforeach
                        </x-kmad.form.select>

                        <x-label for="supplement_id" value="Supplement" class="mt-4"/>
                        <x-kmad.form.select wire:model.defer="newSwimmerSupplement.supplement_id" id="supplement_id"
                                            class="block mt-1 w-full flex-1">
                            <option value="">Selecteer een supplement</option>
                            @foreach($supplements as $supplement)
                                <option value="{{ $supplement->id }}">{{ $supplement->name }}</option>
                            @endforeach
                        </x-kmad.form.select>

                    </div>
                    <div class="flex-1 flex flex-col gap-2 h-auto">
                        <x-label for="name" value="Hoeveelheid" class="mt-4"/>
                        <x-input id="name" type="number"
                                 wire:model.defer="newSwimmerSupplement.amount"
                                 class="mt-1 block w-full flex-1"/>
                        <x-label for="date" value="Innametijd" class="mt-4"/>
                        <x-input id="date" type="datetime-local"
                                 wire:model.defer="newSwimmerSupplement.supplement_schedule"
                                 class="mt-1 block w-full flex-1"/>

                    </div>

                </div>


        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="show = false">Cancel</x-secondary-button>
            @if(is_null($newSwimmerSupplement['id']))
                <x-button
                    wire:click="createNewUserSupplement()"
                    wire:loading.attr="disabled"
                    class="ml-2">Opslaan
                </x-button>
            @else
                <x-button
                    color="success"
                    wire:click="updateNewUserSupplement({{ $newSwimmerSupplement['id'] }})"
                    wire:loading.attr="disabled"
                    class="ml-2">Update
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>

