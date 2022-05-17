@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8">
                <!-- Title -->
                <h1 class="mt-4">{{$item->nickname}}</h1>
                <!-- Author -->
{{--                <p class="lead">--}}
{{--                    Представлений артист:--}}
{{--                    {{$item->artist->nickname}}--}}
{{--                </p>--}}
                <hr>
                <!-- Date/Time -->
                <p>Дата додавання:</p>
                <p>{{$item->created_at}}</p>
                <hr>
                @if($item->image)
                    <img class="img-fluid rounded" src="{{asset(str_replace('public/','storage',$item->image))}}" alt="">
                @endif
                <hr>
{{--                <p>Квитки на концерт</p>--}}
{{--                <ul class="list-group">--}}
{{--                    @foreach($item->tickets as $ticket)--}}
{{--                        <li class="list-group-item"><a href="{{$ticket->url}}">{{$ticket->title}}</a></li>--}}
{{--                    @endforeach--}}

{{--                </ul>--}}
{{--                <div class="card my-4">--}}
{{--                    <h5 class="card-header">Жанр - {{$item->genre->title}}</h5>--}}
{{--                </div>--}}

                <p class="lead">
                    {!! $item->description !!}
                </p>
                <hr>
{{--                <div class="card my-4">--}}
{{--                    <h5 class="card-header">Залиште коментар:</h5>--}}
{{--                    <div class="card-body">--}}
{{--                        <form method="POST" action="{{route('blog.posts.store')}}">--}}
{{--                            @csrf--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="hidden" id="user_id" name="user_id" value="{{auth()->user()->id}}">--}}
{{--                                <input type="hidden" id="blog_post_id" name="blog_post_id" value="{{$item->id}}">--}}
{{--                                <textarea id="text_comment" name="text_comment" class="form-control" rows="3"></textarea>--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-primary">Підтвердити</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                @foreach($item->comments->reverse() as $comments)--}}
{{--                    <div class="media mb-4">--}}
{{--                        <hr>--}}
{{--                        <div class="media-body">--}}
{{--                            <h5 class="mt-0">--}}
{{--                                {{$comments->user->name}}--}}

{{--                            </h5>--}}
{{--                            {{$comments->text_comment}}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                @endforeach--}}
            </div>
        </div>
    </div>
@endsection
