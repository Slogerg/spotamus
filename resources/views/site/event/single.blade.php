@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{url('/css/site/main.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .btn-hover {
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

            background-image: linear-gradient(to right, #f5ce62, #e43603, #fa7199, #e85a19);
            box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);

            border-radius: 50px;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }
        .btn-hover:hover {
            background-position: 100% 0;
            moz-transition: all .4s ease-in-out;
            -o-transition: all .4s ease-in-out;
            -webkit-transition: all .4s ease-in-out;
            transition: all .4s ease-in-out;
        }

        .btn-hover:focus {
            outline: none;
        }

    </style>
    <div style="background: rgb(201,243,1);
background: linear-gradient(219deg, rgba(201,243,1,1) 12%, rgba(144,158,41,1) 44%, rgba(7,23,144,1) 85%);">

        <div class="container-xxl shadow p-3 mb-5 bg-white rounded">
            <div class="row" style="margin-left: 250px; align-items: center">

            <!-- Post Content Column -->
                <div class="col-lg-8" >

                    <!-- Title -->
                    <h1 style="font-weight: 900; font-size: 70px; text-align: center" class="mt-4">{{$item->title}}</h1>

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
                    <p class="lead">
                        Представлений артист:
                        {{$item->artist->nickname}}
                    </p>
                    <hr>
                    <!-- Date/Time -->
                    <p>Початок концерту</p>
                    <p>{{$item->start_date}}</p>
                    <hr>
                    @if($item->image)
                        <img class="img-fluid rounded" src="{{asset(str_replace('public/','storage',$item->image))}}" alt="">
                    @endif
                    <hr>
                    <h1 style="font-weight: 900">Квитки на концерт</h1>

                        @foreach($item->tickets as $ticket)
                            <div class="row">
                                <div class="col-8" ><h3 style="line-height: 100px;">{{$ticket->title}}</h3></div>
                                <div class="col-4"><button class="btn-hover">Купити квитки</button></div>
                                <hr>
                            </div>
                        @endforeach


                    <div class="card my-4">
                        <h5 class="card-header">Жанр - {{$item->genre->title}}</h5>
                    </div>

                    <p class="lead">
                        {!! $item->description !!}
                    </p>
                    <hr>
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
            var type = 'event';

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
    </script>
@endsection
