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
                    <h6 style="color: green;">{{$item->nickname}} from {{$item->from}}</h6>
                    <h2 class="card-title">{{$item->nickname}}</h2>

                    <a class="btn" style="background-color: #00FF00" href="{{route('front.artist.show',$item->slug)}}">Переглянути →</a>
                </div>
                <div class="card-footer text-muted">
                    {{$item->created_at}}
                </div>
            </div>


        @endforeach
    </div>
@endforeach
