@foreach($artists as $item)
{{--    @dd($item)--}}
    <div class="card" style="width: 18rem;">
{{--        @dd($item)--}}
        <img class="card-img-top" src="{{$item->images[0]->url ?? ''}}" alt="Фото не існує">
        <div class="card-body">
            <h5 class="card-title">{{$item->name}}</h5>
            <p class="card-text"></p>
        </div>
        <ul class="list-group list-group-flush">

            <li class="list-group-item">Жанр: {{$item->genres[0] ?? 'Невідомо'}}</li>
            <li class="list-group-item">Кількість підписників: {{$item->followers->total ?? ''}}</li>
        </ul>
        <div class="card-body">
{{--            <form name="form" action="{{route('artist.spotify.send')}}" method="post">--}}
{{--                @csrf--}}
{{--                <input name="nickname" type="text" value="{{$item->name}}" hidden>--}}
{{--                <input name="image" type="text" value="{{$item->images[0]->url ?? ''}}" hidden>--}}
{{--                <button value="{{$item->id}}" type="submit" class="btn btn-success btn-procceed" id="choose" >Обрати</button>--}}
{{--            </form>--}}
            <a href="{{$item->external_urls->spotify}}" class="card-link">Перейти за посиланням</a>
        </div>
    </div>
    <br><br>
@endforeach
