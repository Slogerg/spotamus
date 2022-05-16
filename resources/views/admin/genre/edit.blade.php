@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <form
                    @if(isset($genre->id) && !empty($genre->id))
                        action=" {{route('genre.update',$genre->id)}}"
                    @else
                        action="{{route('genre.store')}}"
                    @endif
                    method="post"
                >
                    @csrf
                    @if(isset($genre->id) && !empty($genre->id))
                        @method('PUT')
                    @endif
                    <br>
                    <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text"
                                   id="title"
                                   name="title"
                                   class="form-control"
                                   placeholder="Title..."
                                   value="{{$genre->title ?? ''}}">
                        </div>

                    </div>
                        <br><br>
                    </div>


                    <textarea id="myeditorinstance" name="description">{!! $genre->description ?? '' !!}</textarea>
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
    </script>
@endsection
