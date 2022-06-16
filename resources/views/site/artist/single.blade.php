@extends('layouts.app')

@section('content')
    <div style="background: rgb(201,243,1);
background: linear-gradient(219deg, rgba(201,243,1,1) 12%, rgba(144,158,41,1) 44%, rgba(7,23,144,1) 85%);">
    <link rel="stylesheet" type="text/css" href="{{url('/css/site/main.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container-xxl shadow p-3 mb-5 bg-white rounded">
        <div class="row" style="margin-left: 250px; align-items: center">
            <!-- Post Content Column -->
            <div class="col-lg-8">
                <!-- Title -->
                <h1 class="mt-4">{{$item->nickname}}</h1>
                <input type="text" value="{{$item->nickname}}" name="nickname" hidden>

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
                @if($item->tickets)
                <ul class="list-group">
                    <p>Квитки на концерт</p>
                    @foreach($item->tickets as $ticket)
                        <li class="list-group-item"><a href="{{$ticket->url}}">{{$ticket->title}}</a></li>
                    @endforeach
                </ul>
                @endif
                @if($item->genre && $item->genre->title)
                    <div class="card my-4">
                        <a class="hover-underline-animation" style="text-decoration: none" href="{{route('front.genre.show',$item->genre->slug)}}"><h5 class="card-header">Жанр - {{$item->genre->title}}</h5></a>
                    </div>
                @endif
                <p class="lead">
                    {!! $item->description !!}
                </p>
                <hr>
                <button class="btn btn-success find-similar">Знайти подібних артистів</button>
                <br><br><br>
                <div id="items-spotify-artists" style="display: flex; justify-content: space-between">

                </div>

            </div>
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
