@foreach($items as $item)
    <div class="col-xl-3 col-sm-6">
        <div class="card" style="width: 18rem">
            <div class="card-body">
                <h5 class="card-title">{{$item->title}}</h5>
                <p class="card-text">
                    {!! substr($item->description, 0, 100) !!}
                </p>
                <a href="{{route('front.genre.show',$item->slug)}}" class="btn btn-success"
                >Взнати більше</a
                >
            </div>
        </div>
    </div>
@endforeach
