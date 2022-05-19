@extends('layouts.app')

@section('content')

    <main>
        <div class="container-xxl page-body">
            <br>
            <input id="search" type="text" style="background-color: white" class="form-control" placeholder="Введіть назву артиста">
            <br>

            <div class="row card-wrapper" id="items-genres">
                @include('site.genre.items',['items' => $items])
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $('#search').on('keyup', function () {
            value = $(this).val();
            console.log(value);
            $.ajax({
                type: 'get',
                url: '{{route('front.genre.search')}}',
                data: {'keywords': value},
                success: function (data) {
                    console.log(data);
                    $("#items-genres").html(data.html);
                }
            });
        })
    </script>

    <script type="text/javascript">
        $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    </script>
@endsection
