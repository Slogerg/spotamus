@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/site/auth.css')}}">

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first auth-header">
            <h1 class="auth-header-text">Login</h1>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" id="email" class="fadeIn third" name="email" placeholder="Email">
            <input type="password" id="password" class="fadeIn third input-password" name="password" placeholder="Password" minlength="8">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        {{--            <div id="formFooter">--}}
        {{--                <a class="underlineHover" href="#">Forgot Password?</a>--}}
        {{--            </div>--}}

    </div>
</div>
@endsection
