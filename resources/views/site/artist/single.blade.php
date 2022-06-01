@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{url('/css/site/main.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container">
        <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8">
                <!-- Title -->
                <h1 class="mt-4">{{$item->nickname}}</h1>
                <input type="text" value="{{$item->nickname}}" name="nickname" hidden>


                <!-- Upvote -->
                <div class="upvote-container">
                    <p class="upvotes" style=" margin-right: 10px">Upvote</p>
                    <p class="upvotes" id='number'>{{$item->upvotes}}</p>
                    <form action="{{route('upvote')}}" method="post">
                        @csrf
                        <input type="text" value="{{$item->id}}" name="id" hidden>
                        <button class="delete-button">
                            <img class="upvote" src="{{url('svg/upvote.svg')}}" alt=""></button>
                    </form>
                </div>

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
                <button class="btn btn-success find-similar">Знайти подібних артистів</button>
                <br><br><br>
                <div id="items-spotify-artists" style="display: flex; justify-content: space-between">
                    {{--                    @include('admin.artist.spotify-items',['items' => $items])--}}
                </div>
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

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".delete-button").click(function(e){
            e.preventDefault();
            var id = $("input[name=id]").val();
            var type = 'artist';

            $.ajax({
                type:'POST',
                url:"{{ route('upvote') }}",
                data:{id:id,type:type},
                statusCode: {
                    401: function() {
                        window.location = "/login";
                    }},
                success:function(data){
                    $('#number').text(data.number);

                }
            });

        });

        $(".find-similar").click(function (e){
            var nickname = $("input[name=nickname]").val();
            if($("#items-spotify-artists").hasClass("active")){
                $("#items-spotify-artists").html('');
                $("#items-spotify-artists").removeClass("active");
            }

            else {
                $.ajax({
                    type: 'GET',
                    url: "{{route('get.similar.artists')}}",
                    data: {nickname: nickname},
                    success: function (data) {
                        if(data.success){
                            $("#items-spotify-artists").html(data.html);
                            $("#items-spotify-artists").addClass("active");
                        }else{
                            alert('Артисти не знайдені');
                        }

                    },

                });
            }
        });
    </script>
@endsection
