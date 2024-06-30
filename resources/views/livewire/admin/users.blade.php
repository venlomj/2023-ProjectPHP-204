<div>
    {{-- show preloader while fetching data in the background --}}
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50 animate-pulse"
         wire:loading>
        <x-kmad.preloader class="bg-blue-700/60 text-white border border-lime-700 shadow-2xl">
            {{ $loading }}
        </x-kmad.preloader>
    </div>
    <div class="my-4">{{ $users->links() }}</div>
    {{--    <div>--}}
    {{--        <x-button type="button" color="success">Voeg gebruiker toe</x-button>--}}
    {{--    </div>--}}
    <x-kmad.section class="mb-4 flex gap-2">
        <div class="flex-1">
            <x-input id="search" type="text" placeholder="Zoek gebruiker op"
                     wire:model.debounce="search"
                     class="w-full shadow-md placeholder-gray-300"/>
        </div>
        <x-button wire:click="setNewUser()">
            Voeg Gebruiker toe
        </x-button>
    </x-kmad.section>
    <x-kmad.section class="p-0 mb-4 flex flex-col gap-2">
        <div style="overflow-x:scroll">
            <table class="text-center table-auto border border-gray-300">
                <thead>
                <tr class="bg-gray-100 text-gray-700 [&>th]:p-2 cursor-pointer">
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Voornaam
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Achternaam
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Federatienummer
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Telefoonnummer
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        E-mailadres
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Geboortedatum
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Inschrijvingsdatum
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Geslacht
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Land
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stad
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Postcode
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Straat
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Huisnummer
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coach
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zwemmer
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Financial
                        Admin
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actief
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="border-t border-gray-300 [&>td]:p-2">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->first_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->last_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->federation_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{  \Carbon\Carbon::parse($user->birth_date)->formatLocalized('%e %B %Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($user->start_date)->formatLocalized('%e %B %Y')  }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ substr($user->sex->name, 0, 1)}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->location->country->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->location->city}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->location->postal_code}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->location->street}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->location->street_number}}</td>

                        @if($user->is_coach == true)
                            <td class="px-6 py-4 whitespace-nowrap"><i class="fa-solid fa-square-check"></i></td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap"><i class="fa-sharp fa-solid fa-xmark fa-lg"></i>
                            </td>
                        @endif
                        @if($user->is_swimmer == true)
                            <td class="px-6 py-4 whitespace-nowrap"><i class="fa-solid fa-square-check"></i></td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap"><i class="fa-sharp fa-solid fa-xmark fa-lg"></i>
                            </td>
                        @endif
                        @if($user->is_financial_administrator == true)
                            <td class="px-6 py-4 whitespace-nowrap"><i class="fa-solid fa-square-check"></i></td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap"><i class="fa-sharp fa-solid fa-xmark fa-lg"></i>
                            </td>
                        @endif
                        @if($user->is_admin == true)
                            <td class="px-6 py-4 whitespace-nowrap"><i class="fa-solid fa-square-check"></i></td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap"><i class="fa-sharp fa-solid fa-xmark fa-lg"></i>
                            </td>
                        @endif
                        @if($user->is_active == true)
                            <td class="px-6 py-4 whitespace-nowrap">ACTIEF</td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap">NIET ACTIEF
                            </td>
                        @endif
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <x-phosphor-pencil-line-duotone wire:click="setNewUser({{ $user->id }})"
                                                            class=" w-5 text-indigo-600 hover:text-indigo-900 ml-4"/>
                            <x-phosphor-trash-duotone x-data=""
                                                      @click="confirm('Are you sure you want to delete this record?') ? $wire.deleteUser({{ $user->id }}) : ''"
                                                      class=" w-5 text-red-600 hover:text-red-900 ml-4"/>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-kmad.section>
    <div class="my-4">{{ $users->links() }}</div>
    <x-dialog-modal id="userModal"
                    wire:model="showModal">
        <x-slot name="title">
            <h2>{{ is_null($newUser['id']) ? 'Nieuwe gebruiker' : 'Edit gebruiker' }}</h2>
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
                <div class="flex-1 flex-col gap-2">

                    <x-label for="first_name" value="Voornaam" class="mt-4"/>
                    <x-input id="first_name" type="text" step="0.01"
                             wire:model.defer="newUser.first_name"
                             class="mt-1 block w-full"/>
                    <x-label for="last_name" value="Achternaam" class="mt-4"/>
                    <x-input id="last_name" type="text" step="0.01"
                             wire:model.defer="newUser.last_name"
                             class="mt-1 block w-full"/>
                    <x-label for="email" value="email" class="mt-4"/>
                    <x-input id="email" type="text" step="0.01"
                             wire:model.defer="newUser.email"
                             class="mt-1 block w-full"/>
                    <x-label for="federation_number" value="federatienummer" class="mt-4"/>
                    <x-input id="federation_number" type="text" step="0.01"
                             wire:model.defer="newUser.federation_number"
                             class="mt-1 block w-full"/>
                    <x-label for="password" value="Wachtwoord" class="mt-4"/>
                    <x-input id="password" type="password" step="0.01"
                             wire:model.defer="newUser.password"
                             class="mt-1 block w-full"/>
                    <x-label for="phone_number" value="Telefoon" class="mt-4"/>
                    <x-input id="phone_number" type="text" step="0.01"
                             wire:model.defer="newUser.phone_number"
                             class="mt-1 block w-full"/>
                    <x-label for="birth_date" value="Geboortedatum" class="mt-4"/>
                    <x-input id="birth_date" type="date" step="0.01"
                             wire:model.defer="newUser.birth_date"
                             class="mt-1 block w-full"/>
                    <x-label for="start_date" value="Startdatum" class="mt-4"/>
                    <x-input id="start_date" type="date" step="0.01"
                             wire:model.defer="newUser.start_date"
                             class="mt-1 block w-full"/>
                    <x-label for="sex_id" value="Geslacht" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newUser.sex_id" id="sex_id"
                                        class="block mt-1 w-full flex-1">
                        <option value="">Kies een type</option>
                        @foreach($sexes as $sex)
                            <option value="{{ $sex->id }}">{{ $sex->name }}</option>
                        @endforeach
                    </x-kmad.form.select>
                    <x-label for="is_admin" value="Admin" class="mt-4" />
                    <x-input id="is_admin" type="checkbox" wire:model="newUser.is_admin" class="mt-1" />

                    <x-label for="is_coach" value="Coach" class="mt-4" />
                    <x-input id="is_coach" type="checkbox" wire:model="newUser.is_coach" class="mt-1" />

                    <x-label for="is_swimmer" value="Zwemmer" class="mt-4" />
                    <x-input id="is_swimmer" type="checkbox" wire:model="newUser.is_swimmer" class="mt-1" />


                    <x-label for="is_financial_administrator" value="Financial Administrator" class="mt-4" />
                    <x-input id="is_financial_administrator" type="checkbox" wire:model="newUser.is_financial_administrator" class="mt-1" />


                    <x-label for="location_street" value="Straat" class="mt-4"/>
                    <x-input id="location_street" type="text" step="0.01"
                             wire:model.defer="newUser.location_street"
                             class="mt-1 block w-full"/>
                    <x-label for="location_street_number" value="Straat nummer" class="mt-4"/>
                    <x-input id="location_street_number" type="number" step="0.01"
                             wire:model.defer="newUser.location_street_number"
                             class="mt-1 block w-full"/>
                    <x-label for="location_city" value="Stad" class="mt-4"/>
                    <x-input id="location_city" type="text" step="0.01"
                             wire:model.defer="newUser.location_city"
                             class="mt-1 block w-full"/>
                    <x-label for="location_postal_code" value="straat nummer" class="mt-4"/>
                    <x-input id="location_postal_code" type="number" step="0.01"
                             wire:model.defer="newUser.location_postal_code"
                             class="mt-1 block w-full"/>
                    <x-label for="location_country_id" value="Land" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newUser.location_country_id" id="location_country_id"
                                        class="block mt-1 w-full flex-1">
                        <option value="">Kies een land</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </x-kmad.form.select>

                    @if($newUser["id"] > 0)
                        <x-label for="is_active" value="Actief" class="mt-4" />
                        <x-input id="is_active" type="checkbox" wire:model="newUser.is_active" class="mt-1" />
                    @endif




                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="show = false">Annuleer</x-secondary-button>
            @if(is_null($newUser['id']))
                <x-button
                    wire:click="createUser()"
                    wire:loading.attr="disabled"
                    class="ml-2">Sla gebruiker op
                </x-button>
            @else
                <x-button
                    color="success"
                    wire:click="updateUser({{ $newUser['id'] }})"
                    wire:loading.attr="disabled"
                    class="ml-2">Update gebruiker
                </x-button>
            @endif


        </x-slot>
    </x-dialog-modal>
</div>




