@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <form
                    @if(isset($ticket->id) && !empty($ticket->id))
                        action=" {{route('ticket.update',$ticket->id)}}"
                    @else
                        action="{{route('ticket.store')}}"
                    @endif
                    method="post"
                >
                    @csrf
                    @if(isset($ticket->id) && !empty($ticket->id))
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
                                   value="{{$ticket->title ?? ''}}">
                        </div>
                        <div class="col">
                            <input type="text"
                                   id="url"
                                   name="url"
                                   class="form-control"
                                   placeholder="Url..."
                                   value="{{$ticket->url ?? ''}}">
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
