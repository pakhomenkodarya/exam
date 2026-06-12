@extends('layouts.app')
@section('title','Редактирование заявки')
@section('main')
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="Alert">
        @foreach($errors->all() as $error)
            {{$error}}<br>
        @endforeach
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert" id="closeBtn"></button>
    </div>
@endif
<h2>Редактирование заявки</h2>
<form action="{{route('appointments.update',$appointment->id)}}" method="post">
    @method('PUT')
    @csrf
    <select class="form-select" name="language">
    <option value="">Выберите иностранный язык</option>
    <option value="Английский"{{$appointment->language=='Английский'?'selected':''}}>Английский</option>
    <option value="Китайский"{{$appointment->language=='Китайский'?'selected':''}}>Китайский</option>
    <option value="Японский"{{$appointment->language=='Японский'?'selected':''}}>Японский</option>
    </select>
  <div class="mb-3">
    <label class="form-label">Установите удобную дату начала обучения</label>
    <input type="date" name="date" value="{{$appointment->date}}" class="form-control" >
  </div>
  <select class="form-select" name="paymethod">
    <option value="">Подходящий способ оплаты</option>
    <option value="предоплата по QR-коду"{{$appointment->paymethod=='предоплата по QR-коду'?'selected':''}}>предоплата по QR-коду</option>
    <option value="оплата картой МИР"{{$appointment->paymethod=='оплата картой МИР'?'selected':''}}>оплата картой МИР</option>
    <option value="постоплата в офисе организации"{{$appointment->paymethod=='постоплата в офисе организации'?'selected':''}}>постоплата в офисе организации</option>
    </select>
  <button type="submit" class="btn btn-light">Отправить</button>
</form>
@endsection