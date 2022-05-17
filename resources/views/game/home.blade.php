@extends('game.master')
@section('content')
{{--    <div class="container">--}}
        <div class="columns">
            <div class="column has-text-centered">
                <p>Одна пісня. 30 секунд. Чи зможете ви згадати дану композиію?</p>
                <p><a class="button is-primary" href="{{ route('game') }}">Грати</a></p>
            </div>
        </div>
{{--    </div>--}}
@endsection
