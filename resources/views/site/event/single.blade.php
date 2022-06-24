@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .btn{
            width: 200px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            margin: 20px;
            height: 55px;
            text-align:center;
            border: none;
            background-size: 300% 100%;

        }


    </style>
    <div style="background: #e8e8e8">

        <div class="container-xxl shadow p-3 mb-5 bg-white rounded">
            <div class="row" style="margin-left: 250px; align-items: center">

            <!-- Post Content Column -->
                <div class="col-lg-8" >

                    <!-- Title -->
                    <h1 style="font-weight: 900; font-size: 70px; text-align: center" class="mt-4">{{$item->title}}</h1>

                    <!-- Author -->
                    <p class="lead">
                        Представлений артист:
                        {{$artist->nickname ?? ''}}
                    </p>
                    <hr>
                    <!-- Date/Time -->
                    <p>Початок концерту</p>
                    <p>{{$item->start_date}}</p>
                    <hr>
                    @if($item->image)
                        <img class="img-fluid rounded" src="{{asset(str_replace('public/','storage',$item->image))}}" alt="">
                    @endif

                    <h1 style="font-weight: 900">Квитки на концерт</h1>

                        @foreach($item->tickets as $ticket)
                            <div class="row">
                                <div class="col-6" ><h3 style="line-height: 100px;">{{$ticket->title}}</h3></div>
                                <div class="col-2" ><h3 style="line-height: 100px;">{{$ticket->price}}$</h3></div>
                                <div class="col-4"><a href="{{$ticket->url}}"><button class="btn btn-dark">Купити квитки</button></a></div>
                                <hr>
                            </div>
                        @endforeach


                    <div class="card my-4">
                        <a class="hover-underline-animation" style="text-decoration: none" href="{{route('front.genre.show',$item->genre->slug)}}"><h5 class="card-header">Жанр - {{$item->genre->title}}</h5></a>
                    </div>

                    <p class="lead">
                        {!! $item->description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
