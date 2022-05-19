@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <a class="btn btn-success create_button" href="{{route('event.create')}}">Create</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Status</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Upvotes</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                        <tr>
                            <th scope="row">{{$event->id}}</th>
                            <td>{{$event->title}}</td>
                            <td>{{$event->venue->title}}</td>
                            <td>{{$event->status}}</td>
                            <td>{{$event->start_date}}</td>
                            <td>{{$event->upvotes}}</td>
                            <td>
                                <div style="display: flex">


                                    <a href=""><img class="svg_icon" src="{{url('svg/view.svg')}}" alt=""></a>
                                    <a href="{{route('event.edit',$event->id)}}"><img class="svg_icon"
                                                                                        src="{{url('svg/edit.svg')}}"
                                                                                        alt=""></a>
                                    <form id='yourFormId' action="{{route('event.delete',$event->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="delete-button" type="submit"><img class="svg_icon" src="{{url('svg/trash.svg')}}" alt=""></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if($events->total() > $events->count())
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    {{ $events->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
