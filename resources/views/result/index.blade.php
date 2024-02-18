<!-- resources/views/result/index.blade.php -->

<h1>Quiz Results</h1>

<div id="results">
    @if(empty($players))
        <p>No players available.</p>
    @else
        @foreach($players as $player)
            <p>{{ $player['name'] }} - {{ $player['buzzed'] ? 'Buzzed' : 'Not Buzzed' }}</p>
        @endforeach
    @endif
</div>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });

    var channel = pusher.subscribe('buzzer-channel');
    channel.bind('App\\Events\\BuzzerPressed', function(data) {
        // Reload the results when the buzzer is pressed
        location.reload();
    });
</script>
