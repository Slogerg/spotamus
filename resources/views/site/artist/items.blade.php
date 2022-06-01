@foreach($items as $item)
    <div class="card mb-4" >
        @if($item->image)
            <img style="width: fit-content; height: 400px; display: block; margin-left: auto; margin-right: auto;"
                 class="img-fluid rounded"
                 src="{{asset(str_replace('public/','storage',$item->image))}}" alt="">
        @else
            <img class="card-img-top" src="https://via.placeholder.com/750x300" alt="Card image cap" />
        @endif
        <div class="card-body">
            <h6 style="color: green;">{{$item->nickname}} from {{$item->from}}</h6>
            <h2 class="card-title">{{$item->nickname}}</h2>

            <a class="btn btn-primary" href="{{route('front.artist.show',$item->slug)}}">Переглянути →</a>
        </div>
        <div class="card-footer text-muted">
            {{$item->created_at}}
        </div>
    </div>
@endforeach
