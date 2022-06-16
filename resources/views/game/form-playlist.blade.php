@extends('game.master')
@section('content')

    <style>
        .hover-underline-animation {
            display: inline-block;
            position: relative;
            color: #0087ca;
        }

        .hover-underline-animation:after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #0087ca;
            transform-origin: bottom right;
            transition: transform 0.25s ease-out;
        }

        .hover-underline-animation:hover:after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
    </style>
    {{--<style>--}}
    {{--    .container{--}}
    {{--        text-align: center;--}}
    {{--        margin-top: 50vh;--}}
    {{--        top: -50%;--}}
    {{--        font-size: 30px;--}}
    {{--    }--}}
    {{--</style>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <div class="row">
        <div class="col-4">
            <a style="text-decoration:none; font-size: 36px" class="hover-underline-animation mt-4" href="{{route('game.select.playlist')}}">Оберіть з існуючих</a>
        </div>
        <div class="col-8 border-left">
            <form action="{{route('game.putPlaylist')}}" method="POST">
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
        </div>
    </div>


@endsection
