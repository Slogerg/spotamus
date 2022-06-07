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

                    <a class="btn" style="height: 55px; line-height: 45px; background-color: #99ff33; font-size: 20px; font-weight: 700" href="{{route('front.event.show',$item->slug)}}">Переглянути</a>
                </div>
                <div class="card-footer text-muted">
                    {{$item->created_at}}
                </div>
            </div>


        @endforeach
    </div>
@endforeach
