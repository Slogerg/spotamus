@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-md-8">
                <h1 class="my-4">
                    Артисти
                </h1>

                @foreach($items as $item)
                    <div class="card mb-4">
                        @if($item->image)
                            <img class="img-fluid rounded" src="{{asset(str_replace('public/','storage',$item->image))}}" alt="">
                        @else
                            <img class="card-img-top" src="https://via.placeholder.com/750x300" alt="Card image cap" />
                        @endif
                        <div class="card-body">
                            <h6 style="color: green;">{{$item->nickname}} from {{$item->from}}</h6>
                            <h2 class="card-title">{{$item->nickname}}</h2>

                            <a class="btn btn-primary" href="{{route('front.artist.show',$item->slug)}}">Переглянути →</a>
                        </div>
                        <div class="card-footer text-muted">
                            {{$item->created_at}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <!-- Side widget-->
                <div class="card my-4">
                    <h5 class="card-header">Всі артисти</h5>
                    <div class="card-body">Тут ви можете отримати доступ до всіх статей блогу</div>
                </div>
            </div>
        </div>
    </div>
@endsection
