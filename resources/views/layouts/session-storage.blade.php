@props(['psKey' => 'paQuiz', 'poData' => [], 'poType' => 'delete'])

@pushOnce('scripts')
    @switch($poType)
        @case('insert')
            <script>
                sessionStorage.setItem('{{ $psKey }}', JSON.stringify({{ Js::from($poData) }}));
                sessionStorage.setItem('piQuestionsPlayed', 0);
            </script>
        @break

        @default
            <script>
                sessionStorage.removeItem({{ $psKey }});
            </script>
    @endswitch
@endPushOnce
