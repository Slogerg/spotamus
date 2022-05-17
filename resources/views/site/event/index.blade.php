@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-md-8">
                <h1 class="my-4">
                    Останні концерти
                </h1>

                @foreach($items as $item)
                    <div class="card mb-4">
                        @if($item->image)
                            <img class="img-fluid rounded" src="{{asset(str_replace('public/','storage',$item->image))}}" alt="">
                        @else
                            <img class="card-img-top" src="https://via.placeholder.com/750x300" alt="Card image cap" />
                        @endif
                        <div class="card-body">
                            <h6 style="color: green;">{{$item->artist->nickname}} on {{$item->venue->title}}</h6>
                            <h2 class="card-title">{{$item->title}}</h2>

                            <a class="btn btn-primary" href="{{route('event.show',$item->slug)}}">Переглянути →</a>
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
                    <h5 class="card-header">Всі статті блогу</h5>
                    <div class="card-body">Тут ви можете отримати доступ до всіх статей блогу</div>
                </div>
            </div>
        </div>
    </div>
@endsection
