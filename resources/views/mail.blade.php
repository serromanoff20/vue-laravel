<div>
    <b>От кого:</b>
    <p><label>ФИО - </label>{{ $order->fromNameUser }}</p>
    <p><label>ПОЧТА - </label>{{ $order->fromEmail }}</p>

    <br />
    <b>Детали заказа:</b>
    @foreach($order->dataOrder as $order)
        <div>
            <p>Наименование: {{$order['name']}}</p>
            <p>Модель: {{$order['model']}}</p>
            <p>Стоимость: {{$order['cost']}} руб.</p>
            <p>Описание: {{$order['description']}}</p>
            <img style="width: 100px; height: 100px" src="{{$message->embed(public_path() . $order['image'])}}" alt="{{$order['name']}}" />
        </div>
        <hr>
    @endforeach

</div>
