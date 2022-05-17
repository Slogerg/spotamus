@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <form
                    @if(isset($event->id) && !empty($event->id))
                        action=" {{route('event.update',$event->id)}}"
                    @else
                        action="{{route('event.store')}}"
                    @endif
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @if(isset($event->id) && !empty($event->id))
                        @method('PUT')
                    @endif
                    <br>
                    <div class="form-group">
                        <input type="text"
                               id="title"
                               name="title"
                               class="form-control"
                               placeholder="Title..."
                               value="{{$event->title ?? ''}}"
                                required
                        >
                    </div>
                    <br><br>
                    <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="datetime-local"
                                   id="start_date"
                                   name="start_date"
                                   class="form-control"
                                   value="{{ isset($event->start_date) ? date('Y-m-d\TH:i', strtotime($event->start_date)) : ''}}"
                                   required>
                        </div>
                        <div class="col">
                            <input type="datetime-local"
                                   id="end_time"
                                   name="end_time"
                                   class="form-control"
                                   value="{{isset($event->end_time) ? date('Y-m-d\TH:i', strtotime($event->end_time)) : ''}}">

                        </div>
                    </div>
                        <br><br>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="file" name="image" value="{{$event->image ?? ''}}">
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for='status'>Status</label><select class="form-control" name="status" id='status'>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Postponed">Postponed</option>
                            <option value="Rescheduled">Rescheduled</option>
                        </select>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <label for='status'>Genre</label>
                        <select class="form-control" name="genre_id" id='genre_id'>
                            @foreach($genres as $genre)
                                <option value="{{$genre->id}}">{{$genre->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br><br>
                    <div class="form-group">

                        <label for="venue_id"> Venue</label>
                            <select class="form-control" name="venue_id">
                                @foreach($venues as $venue)
                                    <option value="{{$venue->id}}">{{$venue->title}}</option>
                                @endforeach
                            </select>
                    </div>
                    <br>
                    <hr>
                    <div class="form-group">

                        <label for="artist_id"> Artist</label>
                        <select class="form-control" name="artist_id">
                            @foreach($artists as $artist)
                                <option value="{{$artist->id}}">{{$artist->nickname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="form-group">
                        <h3>Tickets</h3>
                        @foreach($tickets as $ticket)

                            <input
                                @if(isset($event->id) && \DB::table('event_ticket')->where('ticket_id',$ticket->id)->where('event_id',$event->id)->exists())
                                    checked
                                @endif
                                type="checkbox"
                                class="form-check-input"
                                id="tickets[]"
                                name="tickets[]"
                                value="{{$ticket->id}}">
                            <label for="tickets[]">{{$ticket->title}}</label>
                            <br>
                        @endforeach
                    </div>
                    <br>
                    <textarea id="myeditorinstance" name="description">{!! $event->description ?? '' !!}</textarea>
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
