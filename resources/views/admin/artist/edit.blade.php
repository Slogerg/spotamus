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
                >
                    @csrf
                    @if(isset($artist->id) && !empty($artist->id))
                        @method('PUT')
                    @endif
                    <br>
                    <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text"
                                   id="nickname"
                                   name="nickname"
                                   class="form-control"
                                   placeholder="Name..."
                                   value="{{$artist->nickname ?? ''}}">
                        </div>
                        <div class="col">
                            <input type="text"
                                   id="from"
                                   name="from"
                                   class="form-control"
                                   placeholder="Where from..."
                                   value="{{$artist->from ?? ''}}"
                            >
                        </div>
                    </div>
                        <br><br>
                    </div>

                    <input class="form-control" type="file" name="image" value="{{$artist->image ?? ''}}">
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
    </script>
@endsection
