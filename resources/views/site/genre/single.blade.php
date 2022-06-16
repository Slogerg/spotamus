@extends('layouts.app')

@section('content')

    <div class="container-xxl shadow p-3 mb-5 bg-white rounded">
        <div class="row">
            <div class="col-4">
                <img class="img-fluid rounded" style="height: 232px" src="{{asset('img/forGenre/genre'.rand(1,3).'.jpg')}}" alt="huy">
            </div>
            <div class="col-8">
                <blockquote class="quote-card">
                    <p>
                        {!! substr($item->description, 0, 100) !!}
                    </p>

                    <cite>
                        Адміністратор сайту "Світ музики"
                    </cite>
                </blockquote>
            </div>
        </div>

        @if(!$featured_events->empty())
        <h1>Вибрані концерти для вашого жанру</h1>
        <div class="row">
            @foreach($featured_events as $event)
                <div class="col-4">
                    <div class="card" >
                        <img class="card-img-top" style=" height: 180px" src="{{asset(str_replace('public/','storage',$event->image))}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$event->title}}</h5>
                            <p class="card-text"><small class="text-muted">Дата проведення: {{$event->start_date}}</small></p>
                            <a href="{{route('front.event.show',$event->slug)}}" class="btn main-btn">Перейти до концерту</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <h1>Вибрані концерти для вашого жанру не знайдені..</h1>
        @endif

        <br><br>
        @if(!$featured_events->empty())
        <h1>Артисти, базовані на жанру</h1>
        <div class="row">

            @foreach($featured_artists as $artist)
                <div class="col-4">
                    <div class="card" >
                        <img class="card-img-top" style=" height: 180px" src="{{asset(str_replace('public/','storage',$artist->image))}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$artist->nickname}}</h5>
{{--                            <p class="card-text"><small class="text-muted">Дата проведення: {{$artist->start_date}}</small></p>--}}
                            <a href="{{route('front.artist.show',$artist->slug)}}" class="btn main-btn">Переглянути</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <h1>Вибрані артисти для вибраного жанру не знайдені..</h1>
        @endif

        <div class="row" style="margin-left: 250px; align-items: center">
            <div class="row">

            </div>
        </div>
    </div>

@endsection
