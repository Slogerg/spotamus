@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/site/auth.css')}}">


    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first auth-header">
                <h1 class="auth-header-text">Register</h1>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="text" id="name" class="fadeIn second" name="name" placeholder="Name">
                <input type="text" id="email" class="fadeIn third" name="email" placeholder="Email">
                <input type="password" id="password" class="fadeIn third input-password" name="password" placeholder="Password">
                <div id="password-strength-status"></div>
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="{{ route('login') }}">Є аккаунт? Перейдіть до логінізації</a>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#password").on('keyup', function(){
                var number = /([0-9])/;
                var alphabets = /([a-zA-Z])/;
                var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
                if ($('#password').val().length < 8) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('weak-password');
                    $('#password-strength-status').html("Слабкий (Потрібно більше 8 символів.)");
                } else {
                    if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
                        $('#password-strength-status').removeClass();
                        $('#password-strength-status').addClass('strong-password');
                        $('#password-strength-status').html("Сильний");
                    } else {
                        $('#password-strength-status').removeClass();
                        $('#password-strength-status').addClass('medium-password');
                        $('#password-strength-status').html("Середній");
                    }
                }
            });
        });
    </script>
@endsection
