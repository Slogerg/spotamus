@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-md-8">
                <h1 class="my-4">
                    Останні концерти
                </h1>
                <div class="items-events">
                    @include('site.event.items',['items' => $items])
                </div>

            </div>

            <div class="col-md-4">
                <!-- Side widget-->
                <div class="card my-4">
                    <h5 class="card-header">Пошук подій</h5>
                    <div class="card-body">
                        <input id="search" type="text" class="form-control" placeholder="Введіть назву концерту">
                    </div>
                </div>
            </div>
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
