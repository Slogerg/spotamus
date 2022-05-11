@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <form action="{{route('artist.store')}}" method="post">
                    @csrf
                    <br>
                    <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text" id="nickname" name="nickname" class="form-control" placeholder="Name...">
                        </div>
                        <div class="col">
                            <input type="text" id="from" name="from" class="form-control" placeholder="Where from...">
                        </div>
                    </div>
                        <br><br>
                    </div>
                    <div id="app">
                        <file-uploader
                            :unlimited="true"
                            collection="avatars"
                            :tokens="{{ json_encode(old('media', [])) }}"
                            label="Upload Avatar"
                            notes="Supported types: jpeg, png,jpg,gif"
                            accept="image/jpeg,image/png,image/jpg,image/gif"
                        ></file-uploader>
                    </div>
                    <br>
                    <textarea id="myeditorinstance" name="description"></textarea>
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
