@extends('layouts.app')
@section('content')


<body>

<header class="bg-primary py-5 mb-5">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-12">
                <h1 class="display-4 text-white mt-5 mb-2">Sportamus</h1>
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
            <p>Перейдіть за посиланням і подивіться актуальні тури</p>
            <a class="btn btn-primary btn-lg" href="{{route('front.events')}}">Перейти до подій</a>

        </div>
        <div class="col-md-4 mb-5">
            <h2>Зв'язок</h2>
            <hr>
            <address>
                <strong>Хмельницький</strong>
                <br>район Думка
                <br>Зарічанська 10, 29000
                <br>
            </address>
            <address>
                <abbr title="Phone">Телефон:</abbr>
                (380) 228-1234
                <br>
                <abbr title="Email">Email:</abbr>
                <a href="mailto:#">antonslogerg@gmail.com</a>
            </address>
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
                    <a href="{{route('front.genres')}}" class="btn btn-primary">Жанри</a>
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
                    <a href="{{route('front.artists')}}" class="btn btn-primary">Артисти</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="https://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h4 class="card-title">Замовити послуги програміста</h4>
                    <p class="card-text">По нашому адресу ви знайдете офіс з дуже талановитими програмістами, які допоможуть вам створити і підтримати свій проект.</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Зателефонувати!</a>
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


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
@endsection
