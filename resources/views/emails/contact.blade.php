<x-mail::message>
    # Beste {{ $data['name'] }},
    Bedankt voor u bericht.
    We contacteren u zo snel mogelijk.

    <hr>
    <p>
        <b>Uw naam:</b> {{ $data['name'] }}<br>
        <b>Uw e-mail:</b> {{ $data['email'] }}
    </p>
    <p>
        <b>Uw bericht:</b><br>{!! nl2br($data['message']) !!}
    </p>

    Bedankt,<br>
    {{ config('app.name') }}
</x-mail::message>
