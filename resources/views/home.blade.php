@extends('layouts.app')
@section('content')


<body>

<header class="bg-primary py-5 mb-5" style="background: rgb(4,46,148);
background: linear-gradient(180deg, rgba(4,46,148,1) 0%, rgba(7,116,144,1) 46%, rgba(201,243,1,1) 100%, rgba(0,212,255,1) 100%);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-12">
                <h1 style="font-size: 72px; font-weight: 900" class="display-4 text-white mt-5 mb-2">Sportamus</h1>
                <p class="lead mb-5 text-white-50">Слава Україні - Героям Слава</p>
            </div>
        </div>
    </div>
</header>


<div class="container">

    <div class="row">
        <div class="col-md-8 mb-5">
            <h2>Найближчі події:</h2>
            <hr>
            <img style="width: 500px; height: 250px;" src="{{asset('img/concert.jpg')}}" alt="">

            <p></p>
            <a style="background-color: #00FF00" class="btn btn-lg" href="{{route('front.events')}}">Перейти до подій</a>

        </div>
        <div class="col-md-4 mb-5" >
            <h2>Вибраний актор</h2>
            <img style="width: 250px; height: 250px;" src="{{asset(str_replace('public/','storage',$featured_artist->image))}}" alt="">

            <h3 style="margin-top: 10px">{{$featured_artist->nickname}}</h3>
            <br>
            <a  class="btn" style="background-color: #00FF00" href="{{route('front.artist.show',$featured_artist->slug)}}">Переглянути →</a>
            <br>
            <hr>

        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="https://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h4 class="card-title">Переглянути базу знань про жанри</h4>
                </div>
                <div class="card-footer">
                    <a href="{{route('front.genres')}}" class="btn" style="background-color: #00FF00">Жанри</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="https://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h4 class="card-title">Переглянути інформацію про артистів</h4>
{{--                    <p class="card-text">Редактор допоможе у вашому сайті розмістити певний матеріал який буде притягувати клієнтів</p>--}}
                </div>
                <div class="card-footer">
                    <a href="{{route('front.artists')}}" class="btn" style="background-color: #00FF00">Артисти</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="https://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h4 class="card-title">Перейдіть до гри "Вгадай мелодію"</h4>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <a href="{{route('game')}}" style="background-color: #00FF00" class="btn">Перейти</a>
                </div>
            </div>
        </div>
    </div>

</div>

<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; sportamus 2022</p>
    </div>
</footer>

</body>

</html>
@endsection
