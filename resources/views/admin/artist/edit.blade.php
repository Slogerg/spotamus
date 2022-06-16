@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <form
                    @if(isset($artist->id) && !empty($artist->id))
                        action=" {{route('artist.update',$artist->id)}}"
                    @else
                        action="{{route('artist.store')}}"
                    @endif
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @if(isset($artist->id) && !empty($artist->id))
                        @method('PUT')
                    @endif
                    <br>
                    <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label for="nickname">Назва артиста</label>
                            <input type="text"
                             id="nickname"
                             name="nickname"
                             class="form-control"
                             placeholder="Назва..."
                             value="{{$artist->nickname ?? ''}}">
                        </div>
                        <div class="col">
                            <label for="from">Місце розсташування</label>
                            <input type="text"
                             id="from"
                             name="from"
                             class="form-control"
                             placeholder="Звідки..."
                             value="{{$artist->from ?? ''}}"
                            >
                        </div>
                    </div>
                        <br>
                        <div class="form-group">
                            <label for='status'>Жанр</label>
                            <select class="form-control" name="genre_id" id='genre_id'
                                    style="background-color: white; width: 75%">
                                @foreach($genres as $genre)
                                    @if(isset($artist->genre_id) && $genre->id == $artist->genre_id)
                                    <option selected value="{{$genre->id}}">{{$genre->title}}</option>
                                    @else
                                    <option value="{{$genre->id}}">{{$genre->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <br><br>
                    </div>

                    <p><img id="output" style="max-width: 400px; max-height: 200px;" src="@if(isset($artist->image) && !empty($artist->image)){{asset(str_replace('public/','storage',$artist->image))}} @endif" alt=""></p>
                    <input class="form-control" type="file" name="image" onchange="loadFile(event)" value="{{$artist->image ?? ''}}">

                    <br>
                    <textarea id="myeditorinstance" name="description">{!! $artist->description ?? '' !!}</textarea>
                    <br>
                    <button type="submit" class="btn btn-success">Save</button>

                </form>
            </div>
        </div>
    </div>
    <script src = '{{url('js/admin/create.js')}}'></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });

        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
