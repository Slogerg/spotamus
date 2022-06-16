@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/admin/main.css')}}">
    <div class="container-fluid" style="padding-top: 0px">
        <div class="row flex-nowrap">
            @include('admin.sidebar')
            <div class="col py-3">
                <form id="mainForm"
                    @if(isset($event->id) && !empty($event->id))
                        action="{{route('event.update',$event->id)}}"
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

                    <br><br>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="title">Назва концерту</label>
                                <input type="text"
                                       style="background-color: white; width: 75%"
                                       id="title"
                                       name="title"
                                       class="form-control"
                                       placeholder="Назва концерту..."
                                       value="{{$event->title ?? ''}}"
                                       required
                                >
                            </div>
                            <br>
                            <div class="form-group">
                                <label for='status'>Статус</label><select class="form-control" name="status" id='status'
                                                                          style="background-color: white; width: 75%">
                                    <option value="Scheduled">Заплановано</option>
                                    <option value="Cancelled">Відмінено</option>
                                    <option value="Postponed">Відкладено</option>
                                    <option value="Rescheduled">Перенесено</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for='status'>Жанр</label>
                                <select class="form-control" name="genre_id" id='genre_id'
                                        style="background-color: white; width: 75%">
                                    @foreach($genres as $genre)
                                        @if(isset($event->genre_id) && $genre->id == $event->genre_id)
                                        <option selected value="{{$genre->id}}">{{$genre->title}}</option>
                                        @else
                                        <option value="{{$genre->id}}">{{$genre->title}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="form-group">

                                <label for="venue_id">Місце розміщення</label>
                                <select class="form-control" name="venue_id"
                                        style="background-color: white; width: 75%">
                                    @foreach($venues as $venue)
                                        @if(isset($event->venue_id) && $venue->id == $event->venue_id)
                                        <option selected value="{{$venue->id}}">{{$venue->title}}</option>
                                        @else
                                        <option value="{{$venue->id}}">{{$venue->title}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="start_date">Дата старту</label>
                                <input type="datetime-local"
                                       style="background-color: white"
                                       id="start_date"
                                       name="start_date"
                                       class="form-control"
                                       value="{{ isset($event->start_date) ? date('Y-m-d\TH:i', strtotime($event->start_date)) : ''}}"
                                       required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="end_time">Кінцева дата</label>
                                <input type="datetime-local"
                                       id="end_time"
                                       style="background-color: white"
                                       name="end_time"
                                       class="form-control"
                                       value="{{isset($event->end_time) ? date('Y-m-d\TH:i', strtotime($event->end_time)) : ''}}">
                            </div>


                        </div>


                    </div>
                    <br>
                    <hr>
                    <br><br>
                    <div class="form-group">
                        <p><img id="output" style="max-width: 700px; max-height: 400px;" src="@if(isset($event->image) && !empty($event->image)){{asset(str_replace('public/','storage',$event->image))}} @endif" alt=""></p>

                        <label for="image">Картинка</label>
                        <input class="form-control" style="background-color: white; width: 35%" type="file" id="image" onchange="loadFile(event)"
                               name="image" value="{{$event->image ?? ''}}">
                    </div>
                    <br><br>


                    <br>
                    <hr>
                    <div class="form-group">

                        <label for="artist_id"> Artist</label>
                        <select class="form-control" name="artist_id" style="background-color: white">
                            @foreach($artists as $artist)
                                @if(isset($event->artist_id) && $artist->id == $event->artist_id)
                                <option selected value="{{$artist->id}}">{{$artist->nickname}}</option>
                                @else
                                <option value="{{$artist->id}}">{{$artist->nickname}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="form-group">
                        <div id="all_tickets">
                            @if(isset($tickets))
                                @foreach($tickets as $ticket)
                                    <input hidden id="{{$ticket->id}}" name="tickets[]" value="{{$ticket->id}}">
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-11">
                                <h3>Квитки</h3>
                            </div>

                            <div class="col-1">
                                <button class="btn btn-success" id="createTicket">Створити новий квиток</button>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr style="background-color: white">
                                <th scope="col">#</th>
                                <th scope="col">Назва</th>
                                <th scope="col">Посилання</th>
                                <th scope="col">Ціна</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($tickets))
                                @foreach($tickets as $ticket)
                                    <tr id="{{$ticket->id}}">
                                        <th>{{$ticket->id}}</th>
                                        <th>{{$ticket->title}}</th>
                                        <th>{{$ticket->url}}</th>
                                        <th>{{$ticket->price}}$</th>
                                        <th><button data-id="{{$ticket->id}}" class="btn btn-danger btn-delete-ticket">Delete</button></th>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <textarea id="myeditorinstance" name="description">{!! $event->description ?? '' !!}</textarea>
                    <br>
                    <button type="submit" id="formSubmit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="modalDialog" class="modal">
            <div class="modal-content animate-top">
                <div class="modal-header">
                    <h5 class="modal-title">Створення нового квитка</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" id="formCreateTicket">
                    @csrf
                    <div class="modal-body">
                        <!-- Form submission status -->
                        <div class="response" style="color: green"></div>

                        <!-- Contact form -->
                        <div class="form-group-modal">
                            <label>Назва</label>
                            <input type="text" name="title" id="title" class="form-control"
                                   placeholder="Введіть назву квитка" required="">
                        </div>
                        <div class="form-group-modal">
                            <label>URL</label>
                            <input type="text" name="url" id="url" class="form-control" placeholder="Введіть URL"
                                   required="">
                        </div>
                        <div class="form-group-modal">
                            <label>Ціна</label>
                            <input type="number" name="price" id="price" class="form-control"
                                   placeholder="Введіть початкову ціну">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Submit button -->
                        <button type="submit" class="btn-modal btn-primary-modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src='{{url('js/admin/create.js')}}'></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

        var modal = $('#modalDialog');

        // Get the button that opens the modal
        var btn = $("#createTicket");

        // Get the  element that closes the modal
        var span = $(".close");


        // When the user clicks the button, open the modal
        btn.on('click', function (e) {
            e.preventDefault();
            modal.show();
        });

        // When the user clicks on  (x), close the modal
        span.on('click', function () {
            modal.hide();
        });

        // When the user clicks anywhere outside of the modal, close it
        $('body').bind('click', function (e) {
            if ($(e.target).hasClass("modal")) {
                modal.hide();
            }
        });

        $('.btn-delete-ticket').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                type: "DELETE",
                url: '/admin/events/delete/ticket/'+id,
                data: {
                    "id": id,
                    "_token": token,
                },
                dataType: 'json',
                success: function (response) {
                    if(response.success){
                        id = response.id;
                        var row = $('#'+response.id);
                        row.remove();
                        var input = $('#'+response.id)
                        input.remove();
                    }
                }
            });

        })

        $('#formCreateTicket').submit(function (e) {
            e.preventDefault();
            $('.modal-body').css('opacity', '0.5');
            // $('.btn-modal').prop('disabled', true);

            $form = $(this);
            $.ajax({
                type: "POST",
                url: '{{route('event.create.ticket')}}',
                data: $form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.status == 1) {
                        $('#formCreateTicket')[0].reset();
                        $('.response').html('' + response.message + '');
                    } else {
                        $('.response').html('' + response.message + '');
                    }
                    $('.modal-body').css('opacity', '');
                    // $('.btn-modal').prop('disabled', false);
                    var row = "<tr id="+response.id+" style='background-color: white'><td>" + response.id + "</td><td>" + response.title +
                        "</td><td>" + response.url + "</td><td>" + response.price +"$"+ "</td>"+"<th><button data-id="+response.id+" class='btn btn-danger btn-delete-ticket'>Delete</button>"+"</th></tr>";
                    $("table tbody").append(row);
                    var input = "<input hidden name='tickets[]' value='" + response.id + "'>"
                    $("#all_tickets").append(input);

                }
            });
        });
    </script>
@endsection
