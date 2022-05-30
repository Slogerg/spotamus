@foreach($items->artists->items as $item)
<div class="card" style="width: 18rem;">
@dd($item)
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
        <form name="form" action="{{route('artist.spotify.send')}}" method="post">
            @csrf
            <input name="nickname" type="text" value="{{$item->name}}" hidden>
            <input name="image" type="text" value="{{$item->images[0]->url ?? ''}}" hidden>
            <button value="{{$item->id}}" type="submit" class="btn btn-success btn-procceed" id="choose" >Обрати</button>
        </form>
        <a href="{{$item->external_urls->spotify}}" class="card-link">Перейти за посиланням</a>
    </div>
</div>
<br><br>
{{--<script type="text/javascript">--}}
{{--    $('.btn-procceed').click(function (e) {--}}
{{--        e.preventDefault();--}}
{{--        var val = $(this).val();--}}
{{--        console.log(val);--}}
{{--        // var form = $(this).closest('form');--}}
{{--        $.ajax({--}}
{{--            type: 'post',--}}
{{--            url: '{{route('artist.spotify.send')}}',--}}
{{--            data: { "_token": "{{ csrf_token() }}", 'url': val},--}}
{{--            success: function (data) {--}}
{{--                console.log(data);--}}
{{--                window.location.replace('{{route('artist.index')}}')--}}
{{--            }--}}
{{--        });--}}
{{--    })--}}
{{--</script>--}}
{{--<script type="text/javascript">--}}
{{--    $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});--}}
{{--</script>--}}
@endforeach
