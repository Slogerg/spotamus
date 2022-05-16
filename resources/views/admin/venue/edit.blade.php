@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <form
                    @if(isset($venue->id) && !empty($venue->id))
                        action=" {{route('venue.update',$venue->id)}}"
                    @else
                        action="{{route('venue.store')}}"
                    @endif
                    method="post"
                >
                    @csrf
                    @if(isset($venue->id) && !empty($venue->id))
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
                                   placeholder="Name..."
                                   value="{{$venue->title ?? ''}}">
                        </div>
                    </div>
                        <br><br>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>

                </form>
            </div>
        </div>
    </div>
    <script src = '{{url('js/admin/create.js')}}'></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection
