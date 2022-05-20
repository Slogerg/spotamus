@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                    @csrf
                    <br>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text"
                                       id="name"
                                       name="name"
                                       class="form-control"
                                       placeholder="Enter name..."
                                >
                            </div>

                        </div>
                        <br><br>
                    </div>
                    <button id="search_artist" type="submit" class="btn btn-success">Пошук</button>
                <br><br>
                <div id="items-spotify-artists" style="display: flex; justify-content: space-between">
{{--                    @include('admin.artist.spotify-items',['items' => $items])--}}
                </div>
            </div>
        </div>
    </div>
    <script src='{{url('js/admin/create.js')}}'></script>

    <script type="text/javascript">
        $('#search_artist').on('click', function () {
            var value = $('#name').val();
            console.log(value);
            $.ajax({
                type: 'get',
                url: '{{route('artist.spotify.post')}}',
                data: {'name': value},
                success: function (data) {
                    console.log(data);
                    $("#items-spotify-artists").html(data.html);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    </script>
@endsection
