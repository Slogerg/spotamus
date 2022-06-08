@foreach($items->chunk(2) as $chunk)
    <div class="row">
        @foreach($chunk as $item)
            <div class="card col-5" style="margin-bottom: 50px; margin-right: 20px">
                @if($item->image)
                    <img style="width: fit-content; height: 400px; display: block; margin-left: auto; margin-right: auto;"
                         class="img-fluid rounded"
                         src="{{asset(str_replace('public/','storage',$item->image))}}" alt="">
                @else
                    <img style="width: fit-content; height: 400px; display: block; margin-left: auto; margin-right: auto" class="img-fluid rounded" src="https://via.placeholder.com/750x300" alt="Card image cap" />
                @endif
                <div class="card-body">
                    <h6 style="color: green;">{{$item->artist->nickname}} on {{$item->venue->title}}</h6>
                    <h2 class="card-title">{{$item->title}}</h2>

                    <a class="btn main-btn" href="{{route('front.event.show',$item->slug)}}">Переглянути</a>
                </div>
                <div class="card-footer text-muted" style="height: 45px">

                    <div class="upvote-container">
                        {{$item->created_at}}
                            <p class="upvotes" id='{{'number-'.$item->id}}' style="margin-left: auto">{{$item->upvotes}}</p>
                            <form action="{{route('upvote')}}" method="post">
                                @csrf
                                <input type="text" value="{{$item->id}}" name="id" hidden>
                                <button class="delete-button" type="submit">
                                    <img class="upvote" src="{{url('svg/upvote.svg')}}" alt="">
                                </button>
                            </form>
                    </div>
                </div>
            </div>


        @endforeach
    </div>
@endforeach
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".delete-button").click(function(e){
        e.preventDefault();
        var id = $(this).parent().find("input[name=id]").val();
        var type = 'event';
        $.ajax({
            type:'POST',
            url:"{{ route('upvote') }}",
            data:{id:id,type:type},
            statusCode: {
                401: function() {
                    window.location = "/login";
                }},
            success:function(data){
                $('#number-'+id).text(data.number);
            }
        });

    });
</script>
