@if ($errors->any())
    <x-kmad.alert type="danger">
        <x-kmad.list>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </x-kmad.list>
    </x-kmad.alert>
@endif
