@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <a class="btn btn-success create_button" href="{{route('ticket.create')}}">Create</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <th scope="row">{{$ticket->id}}</th>
                            <td>{{$ticket->title}}</td>

                            <td>{{$ticket->created_at}}</td>
                            <td>
                                <div style="display: flex">
                                    <a href="{{route('ticket.edit',$ticket->id)}}"><img class="svg_icon"
                                                                                        src="{{url('svg/edit.svg')}}"
                                                                                        alt=""></a>
                                    <form id='yourFormId' action="{{route('ticket.delete',$ticket->id)}}" method="post">
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
            </div>
        </div>
    </div>
@endsection
