<!-- resources/views/buzzer/index.blade.php -->

<h1>Quiz Buzzer</h1>

@if(empty($players))
    <form method="post" action="{{ route('buzzer.addPlayers') }}">
        @csrf
        <button type="submit">Add Players</button>
    </form>
@else
    @foreach($players as $player)
        <p>{{ $player['name'] }} - {{ $player['buzzed'] ? 'Buzzed' : 'Not Buzzed' }}</p>
        @if(!$player['buzzed'])
            <form method="post" action="{{ route('buzzer.buzz', $player['id']) }}">
                @csrf
                <button type="submit">Buzz</button>
            </form>
        @endif
    @endforeach

    <form method="post" action="{{ route('buzzer.reset') }}">
        @csrf
        <button type="submit">Reset Buzzer</button>
    </form>

    <a href="{{ route('result.index') }}">View Results</a>
@endif
