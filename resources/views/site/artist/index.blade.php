@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-md-8">
                <h1 class="my-4">
                    Артисти
                </h1>
                <div class="items-artists">
                    @include('site.artist.items',['items' => $items])
                </div>
            </div>

            <div class="col-md-4">
                <!-- Side widget-->
                <div class="card my-4">
                    <h5 class="card-header">Пошук артиста</h5>
                    <div class="card-body">
                        <input id="search" type="text" class="form-control" placeholder="Введіть назву артиста">
                    </div>
                </div>
            </div>
        </div>
{{--        @if($items->total() > $items->count())--}}
{{--            <br>--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            {{ $items->links() }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>


    <script type="text/javascript">
        $('#search').on('keyup', function () {
            value = $(this).val();
            console.log(value);
            $.ajax({
                type: 'get',
                url: '{{route('front.artist.search')}}',
                data: {'keywords': value},
                success: function (data) {
                    console.log(data);
                    $(".items-artists").html(data.html);
                }
            });
        })
    </script>

    <script type="text/javascript">
        $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    </script>
@endsection
