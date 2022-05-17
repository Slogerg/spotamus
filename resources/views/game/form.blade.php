@extends('game.master')
@section('content')


    @if ($update == 'Right')
        <div class="message is-success has-text-centered">
            <div class="message-body">
                <i class="far fa-check-circle"></i> <strong>Правильно!</strong>
                - Ви отримали <strong>{{ $last_score }}</strong> балів
            </div>
        </div>
    @endif

    @if ($update == 'Wrong')
        <div class="message is-danger has-text-centered">
            <div class="message-body">
                <i class="far fa-exclamation-circle"></i> <strong>Неправильно!</strong>
                - You втратили <strong>{{ $last_score }}</strong> балів!
            </div>
        </div>
    @endif

    @if ($update == 'Timeout')
        <div class="message is-dark has-text-centered">
            <div class="message-body">
                <i class="far fa-clock"></i> <strong>Час вийшов!</strong>
                - Не забудь відгадати наступне...
            </div>
        </div>
    @endif

    <audio autoplay id="song">
        <source src="{!! $track->preview_url !!}" type="audio/mp3">
    </audio>
    <form action="/game/guess" method="post">
        {!! csrf_field() !!}
        <input id="time" name="time" type="hidden" value="" />
        <div class="columns">
            <div class="column has-text-centered">
                <p>Дай відповідь зараз і ти отримаєш <strong id="score"></strong> балів!</p>
                <progress class="progress is-info" id="playtime" max="30" value="0"></progress>

                @if (Auth::check())
                    <div class="columns">
                        <div class="column">
                            Відгадано:<br />
                            <span class="is-size-1">{{ Auth::user()->songs_correct }}</span> / {{ Auth::user()->songs_seen }}</small>
                        </div>
                        <div class="column">
                            Балів:<br />
                            <span class="is-size-1">{{ Auth::user()->score }}</span>
                        </div>
                    </div>
                @else
                    <div class="columns">
                        <div class="column">
                            <p>Хочете зберегти статистику в таблиці лідерів?</p>
                            <p><a class="button is-info" href="/register">Реєстрація</a> or <a class="button is-primary" href="/login">Логін</a></p>
                        </div>
                    </div>


                @endif
            </div>
            <div class="column">
                <h3>Це....</h3>
                @foreach ($answers as $answer)
                    <button
                        class="button is-success"
                        name="answer"
                        type="submit"
                        value="{{ $answer->track->id }}"
                    ><i class="far fa-music"></i>&nbsp;&nbsp;{{ \Illuminate\Support\Str::limit($answer->track->name,25) }} - {{ \Illuminate\Support\Str::limit(collect($answer->track->artists)->implode('name',', '),25) }}&nbsp;&nbsp;<i class="far fa-music"></i></button>
                @endforeach
            </div>
        </div>
    </form>


@endsection

@section('script')
    <script>
        // Update the form to show how far into the song we are
        setInterval(function() {
            // Find out how much of the sample has played
            elapsedTime = document.getElementById('song').currentTime;
            // Update the progress bar and form field
            document.getElementById('playtime').value = elapsedTime;
            document.getElementById('time').value = elapsedTime;
            // Update the score banner
            scoreNow = Math.ceil((30 - elapsedTime) / 3);
            document.getElementById('score').innerText = scoreNow;
        },10);
        // If the song ends without an answer being given, reload the page
        document.getElementById('song').onended = function() {
            location.href = '/game/timeout';
        };
    </script>
@endsection
