@extends('game.master')
@section('content')
    {{--<style>--}}
    {{--    .container{--}}
    {{--        text-align: center;--}}
    {{--        margin-top: 50vh;--}}
    {{--        top: -50%;--}}
    {{--        font-size: 30px;--}}
    {{--    }--}}
    {{--</style>--}}


    <form style=" padding: 0 500px" action="{{route('game.putPlaylist')}}" method="POST">
        @csrf

        <label>Введіть ID плейліста (<a target="_blank" href="{{asset('img/id_test.png')}}">Де знайти</a>)
            <input name = "playlist" style="width: 100%" class="form-control" type="text" >
        </label>
        <button style="  background-color: #555555; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;" type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
