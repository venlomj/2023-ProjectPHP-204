<div>

    <x-kmad.section
        x-data="{ open: false }"
        class="p-0 mb-4 flex flex-col gap-2">

        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-button wire:click="setNewProducts()">
                    Nieuw product
                </x-button>

            </div>

            <x-heroicon-o-information-circle
                @click="open = !open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newProduct" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-kmad.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    Op deze pagina kan de financieel beheerder de producten beheren.
                </li>
            </x-kmad.list>
        </div>
    </x-kmad.section>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div style="overflow-x:scroll">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Type</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product naam</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Maat</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actief</th>

            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <div class="my-4">{{ $products->links() }}</div>
            @foreach ($products as $product)
                <tr wire:key="$product_{{ $product->id }}">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->productType_Name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->measure_name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <x-phosphor-pencil-line-duotone class="outline-0"
                                                        data-tippy-content="Aanpassen" wire:click="setNewProducts({{ $product->id }})"
                                                        class=" w-5 text-indigo-600 hover:text-indigo-900 ml-4"/>
                        <x-phosphor-trash-duotone class="outline-0"
                                                  data-tippy-content="Verwijderen" x-data=""
                                                   @click="confirm('Bent u zeker dat u dit product wilt verwijderen?') ? $wire.deleteProducts({{ $product->id }}) : ''"
                                                   class=" w-5 text-red-600 hover:text-red-900 ml-4"/>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->is_active }}</td>


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    <x-dialog-modal id="productModal"
                    wire:model="showModal">
        <x-slot name="title">
            <h2>{{ is_null($newProduct['id']) ? 'Nieuw product' : 'Aanpassen product' }}</h2>
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
                             wire:model.defer="newProduct.name"
                             class="mt-1 block w-full flex-1"/>

                    <x-label for="product_type_id" value="Product Type" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newProduct.product_type_id" id="product_type_id" class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een Type</option>
                        @foreach($productTypes as $productType)
                            <option value="{{ $productType->id }}">{{ $productType->name}}</option>
                        @endforeach
                    </x-kmad.form.select>

                    <x-label for="measurement_id" value="Maat" class="mt-4"/>
                    <x-kmad.form.select wire:model.defer="newProduct.measurement_id" id="measurement_id" class="block mt-1 w-full flex-1">
                        <option value="">Selecteer een Maat</option>
                        @foreach($measures as $measure)
                            <option value="{{ $measure->id }}">{{ $measure->name}}</option>
                        @endforeach
                    </x-kmad.form.select>


                    <x-label for="is_active" value="Active" class="mt-4"/>
                    <x-input id="is_active" type="number"
                             wire:model.defer="newProduct.is_active"
                             class="mt-1 block w-full flex-1"/>
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="show = false">Cancel</x-secondary-button>
            @if(is_null($newProduct['id']))
                <x-button
                    wire:click="createProducts()"
                    wire:loading.attr="disabled"
                    class="ml-2">Opslaan
                </x-button>
            @else
                <x-button
                    color="success"
                    wire:click="updateProducts({{ $newProduct['id'] }})"
                    wire:loading.attr="disabled"
                    class="ml-2">Update
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>
</div>
