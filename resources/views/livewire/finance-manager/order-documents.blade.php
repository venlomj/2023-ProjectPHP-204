<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
<div style="overflow-x:scroll">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aantal</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Maat</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($orderDocuments as $orderDocument)
            <tr wire:key="$orderDocument_{{ $orderDocument->id }}">
                <td class="px-6 py-4 whitespace-nowrap">{{ $orderDocument->name}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $orderDocument->orderlines->sum('amount')}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $orderDocument->measurement->name}}</td>



            </tr>
        @endforeach
        </tbody>
    </table>
</div>
