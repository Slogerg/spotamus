@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <a class="btn btn-success create_button" href="{{route('genre.create')}}">Create</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($genres as $genre)
                        <tr>
                            <th scope="row">{{$genre->id}}</th>
                            <td>{{$genre->title}}</td>
                            <td>{{$genre->slug}}</td>
                            <td>{{$genre->created_at}}</td>
                            <td>
                                <div style="display: flex">
                                    <a href="{{route('front.genre.show',$genre->id)}}"><img class="svg_icon" src="{{url('svg/view.svg')}}" alt=""></a>
                                    <a href="{{route('genre.edit',$genre->id)}}"><img class="svg_icon"
                                                                                        src="{{url('svg/edit.svg')}}"
                                                                                        alt=""></a>
                                    <form id='yourFormId' action="{{route('genre.delete',$genre->id)}}" method="post">
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
                @if($genres->total() > $genres->count())
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    {{ $genres->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
