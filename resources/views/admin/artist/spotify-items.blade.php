@foreach($items->artists->items as $item)
<div class="card" style="width: 18rem;">

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
        <a href="#" class="card-link">Обрати</a>
        <a href="{{$item->external_urls->spotify}}" class="card-link">Перейти за посиланням</a>
    </div>
</div>
<br><br>
@endforeach
