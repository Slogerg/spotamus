@extends('layouts.app')

@section('content')

    <div class="container-xxl page-body">
        <h1 class="my-4">
            Артисти
        </h1>
        <input id="search" type="text" class="form-control" placeholder="Введіть назву артиста">
        <br>
            <!-- Blog entries-->
            <div class="items-artists">
                @include('site.artist.items',['items' => $items])
            </div>
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
