@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{url('/css/site/main.css')}}">
    <div class="container-xxl page-body">
        <h1 class="my-4">
            Останні концерти
        </h1>
        <div class="container">
            <div class="row">
                <div class="col-9  mx-auto">
                    <input id="search" type="text" class="form-control" placeholder="Введіть назву концерту">
                </div>
                <div class="col-3">
                    <button style="background-color: #00FF00" class="btn" type="submit">Пошук</button>
                </div>
            </div>
        </div>
        <br><br>
        <div class="items-events">
            @include('site.event.items',['items' => $items])
        </div>
    </div>
    <script type="text/javascript">
        $('#search').on('keyup', function () {
            value = $(this).val();
            console.log(value);
            $.ajax({
                type: 'get',
                url: '{{route('front.event.search')}}',
                data: {'keywords': value},
                success: function (data) {
                    console.log(data);
                    $(".items-events").html(data.html);
                }
            });
        })
    </script>

    <script type="text/javascript">
        $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    </script>
@endsection
