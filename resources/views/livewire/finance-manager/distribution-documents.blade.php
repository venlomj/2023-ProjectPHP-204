@push('styles')
    <link href="resources\css\app.css" rel="stylesheet">
@endpush

<div>
    @foreach ($users as $user)
        @if (count($user->orders) > 0 && count($user->orders->pluck('orderlines')->flatten()) > 0)
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg my-4">
            <h2 class="font-bold text-lg uppercase p-4">{{ $user->first_name }} {{ $user->last_name }}</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 p-6">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($user->orders as $order)
                    @foreach ($order->orderlines as $orderline)
                        <tr>
                            <td class="table-cell px-6 py-4 whitespace-nowrap">{{ $orderline->product->name }}</td>
                            <td class="table-cell amount px-6 py-4 whitespace-nowrap text-center">{{ $orderline->amount }}</td>
                            <td class="table-cell size px-6 py-4 whitespace-nowrap text-center">{{ $orderline->product->measurement->name }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endforeach
</div>

