@extends('game.master')
@section('content')
    <div class="container">
        <div class="columns">
            <div class="column">
                <h1 class="title">Список переможців</h1>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Ім'я</th>
                        <th>Вгадано / Пройдено</th>
                        <th>Балів</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($leaderboard as $row)
                        <tr {!! (Auth::id() == $row->id ? ' class="is-selected"' : '') !!}>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->songs_correct }} / {{ $row->songs_seen }}</td>
                            <td><strong>{{ $row->score }}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
@endsection
