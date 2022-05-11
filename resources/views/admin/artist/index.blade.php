@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <a class="btn btn-success create_button" href="{{route('artist.create')}}">Create</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">From</th>
                        <th scope="col">Upvotes</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($artists as $artist)
                            <tr>
                                <th scope="row">{{$artist->id}}</th>
                                <td>{{$artist->nickname}}</td>
                                <td>{{$artist->from}}</td>
                                <td>{{$artist->upvotes}}</td>
                                <td>{{$artist->created_at}}</td>
                                <td>
                                    <div>

                                    </div>
                                    <a href=""><img class="svg_icon" src="{{url('svg/view.svg')}}" alt=""></a>
                                    <a href=""><img class="svg_icon" src="{{url('svg/edit.svg')}}" alt=""></a>
                                    <a href=""><img class="svg_icon" src="{{url('svg/trash.svg')}}" alt=""></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
