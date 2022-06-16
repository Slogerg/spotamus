@extends('game.master')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .zoom{
            transition: transform .2s;
        }
        .zoom:hover {
            transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
        .imgbox {
            float: left;
            text-align: center;
            width: 120px;
            border: 1px solid gray;
            margin: 4px;
            padding: 6px;
        }
    </style>
    <div class="row">
{{--        @dd($playlists)--}}
        @foreach($playlists as $playlist)
            <div class="col-3 mb-5">
                <form action="{{route('game.putPlaylistFromImages',$playlist->id)}}" id="my_form" method="post">
                    @csrf
                    <button style="padding: 0;
border: none;
background: none;" type="submit">
                        <img style="max-width: 200px; max-height: 200px" src="{{$playlist->images[0]->url}}" class="zoom" alt="Error">
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
